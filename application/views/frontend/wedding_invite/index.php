<!DOCTYPE html>
<html lang="en" class="bg-dark">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, user-scalable=no">
     <?php
          if ($_SERVER['SERVER_NAME'] == 'localhost') {
               echo '
               <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
               <meta http-equiv="Pragma" content="no-cache">
               <meta http-equiv="Expires" content="0">
               ';
          }
     ?>
     <meta property="og:type" content="website">
     <meta property="og:title" content="<?= $e->alias_woman ?> &amp; <?= $e->alias_man ?>">
     <meta property="og:description" content="<?= day_indo($e->reception_date) . ", " . date_indo($e->reception_date) ?>">
     <!-- <meta property="og:image" content="<?= base_url("$dir_img/thumbnail2.jpg?_timestamp=$timest") ?>">
     <meta property="og:image:secure_url" content="<?= base_url("$dir_img/thumbnail2.jpg?_timestamp=$timest") ?>"> -->
     <meta property="og:image" content="<?= base_url("$dir_img/thumbnail.jpg?_timestamp=$timest") ?>">
     <meta property="og:image:secure_url" content="<?= base_url("$dir_img/thumbnail.jpg?_timestamp=$timest") ?>">
     <meta property="og:site_name" content="AriolaJanahtan">
     <meta property="og:image:type" content="image/jpg">
     <meta property="og:image:width" content="450">
     <meta property="og:image:height" content="450">
     <meta name="twitter:card" content="summary_large_image">
    	<meta name="twitter:site" content="@rizkikosasih">
    	<meta name="twitter:creator" content="@rizkikosasih">
    	<meta name="twitter:title" content="<?= $e->alias_woman ?> &amp; <?= $e->alias_man ?>">
    	<meta name="twitter:image:src" content="<?= base_url("$dir_img/thumbnail.jpg?_timestamp=$timest") ?>">
    	<meta name="twitter:url" content="<?= base_url() ?>">
    	<meta name="twitter:description" content="<?= day_indo($e->reception_date) . ", " . date_indo($e->reception_date) ?>">
     <meta name="version" content="1.1.0">
     <title><?= $e->alias_woman ?> & <?= $e->alias_man ?></title>
     <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url("assets/public/images/apple-touch-icon.png?_timestamp=$timest") ?>">
     <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url("assets/public/images/favicon-32x32.png?_timestamp=$timest") ?>">
     <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("assets/public/images/favicon-16x16.png?_timestamp=$timest") ?>">
     <link rel="manifest" href="<?= base_url("assets/public/images/site.webmanifest?_timestamp=$timest") ?>">

     <?php $this->load->view('templates/frontend/css') ?>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="51" class="bg-dark">
     <audio id="myAudio" src="<?= base_url("assets/public/music/bg-music.mp3?_timestamp=$timest") ?>" preload="auto" loop="true"></audio>
     <div class="preload">
          <div class="lds-heart">
               <div></div>
          </div>
     </div>

     <!-- Navbar Start -->
     <nav class="navbar fixed-top shadow-sm navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5 navbar-top " style="opacity: 0;">
          <a href="javascript:void(0)" class="navbar-brand d-block d-lg-none">
               <h1 class="font-secondary text-white text-capitalize mb-n2">
                    <?= $e->alias_woman ?> <span class="text-primary">&</span> <?= $e->alias_man ?>
               </h1>
          </a>
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
               <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
               <div class="navbar-nav ml-auto py-0">
                    <a href="#home" class="nav-item nav-link active">beranda</a>
                    <a href="#about" class="nav-item nav-link">couple</a>
                    <a href="#story" class="nav-item nav-link">story</a>
                    <a href="#gallery" class="nav-item nav-link">galeri</a>
               </div>
               <a href="javascript:void(0)" class="navbar-brand mx-5 d-none d-lg-block">
                    <h1 class="font-secondary text-white text-capitalize mb-n2">
                         <?= $e->alias_woman ?> <span class="text-primary">&</span> <?= $e->alias_man ?>
                    </h1>
               </a>
               <div class="navbar-nav mr-auto py-0">
                    <a href="#event" class="nav-item nav-link">acara</a>
                    <a href="#gift" class="nav-item nav-link">hadiah</a>
                    <a href="#comment" class="nav-item nav-link">doa</a>
                    <a href="#map" class="nav-item nav-link" style="visibility: hidden;">lokasi</a>
               </div>
          </div>
     </nav>
     <!-- Navbar End -->

     <?php
          $this->load->view('frontend/wedding_invite/cover');
          $this->load->view('frontend/wedding_invite/home');
          $this->load->view('frontend/wedding_invite/about');
          $this->load->view('frontend/wedding_invite/story');
          $this->load->view('frontend/wedding_invite/gallery');
          $this->load->view('frontend/wedding_invite/event');
          // $this->load->view('frontend/wedding_invite/map');
          $this->load->view('frontend/wedding_invite/gift');
          $this->load->view('frontend/wedding_invite/comment');
          $this->load->view('frontend/wedding_invite/closing');
          $this->load->view('frontend/wedding_invite/footer');
     ?>

     <?php $this->load->view('templates/frontend/js.php') ?>
</body>
</html>