<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Ariola & Janahtan</title>
     <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/public/images/apple-touch-icon.png') ?>">
     <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/public/images/favicon-32x32.png') ?>">
     <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/public/images/favicon-16x16.png') ?>">
     <link rel="manifest" href="<?= base_url('assets/public/images/site.webmanifest') ?>">

     <?php $this->load->view('templates/frontend/css.php') ?>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="51">
     <!-- Navbar Start -->
     <nav class="navbar fixed-top shadow-sm navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
          <a href="index.html" class="navbar-brand d-block d-lg-none">
               <h1 class="font-secondary text-white text-capitalize mb-n2">
                    <?= $e->alias_woman ?> <span class="text-primary">&</span> <?= $e->alias_man ?>
               </h1>
          </a>
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
               <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
               <div class="navbar-nav ml-auto py-0">
                    <a href="#home" class="nav-item nav-link active">Home</a>
                    <a href="#about" class="nav-item nav-link">About</a>
                    <a href="#story" class="nav-item nav-link">Story</a>
                    <a href="#gallery" class="nav-item nav-link">Gallery</a>
               </div>
               <a href="index.html" class="navbar-brand mx-5 d-none d-lg-block">
                    <h1 class="font-secondary text-white text-capitalize mb-n2">
                         <?= $e->alias_woman ?> <span class="text-primary">&</span> <?= $e->alias_man ?>
                    </h1>
               </a>
               <div class="navbar-nav mr-auto py-0">
                    <a href="#family" class="nav-item nav-link">Family</a>
                    <a href="#event" class="nav-item nav-link">Event</a>
                    <a href="#rsvp" class="nav-item nav-link">RSVP</a>
                    <a href="#contact" class="nav-item nav-link">Contact</a>
               </div>
          </div>
     </nav>
     <!-- Navbar End -->

     <!-- Carousel Start -->
     <div class="container-fluid p-0 mb-5 pb-5" id="home">
          <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
               <div class="carousel-inner">
                    <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                         <img class="position-absolute w-100 h-100" src="<?= base_url("$dir_img/event/$e->background_home") ?>" style="object-fit: cover;">
                         <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                              <div class="p-3" style="max-width: 900px;">
                                   <h1 class="display-1 font-secondary text-white text-capitalize mt-n3 mb-md-4">
                                        <?= $e->alias_woman ?> & <?= $e->alias_man ?>
                                   </h1>
                                   <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                        <h3 class="text-uppercase font-weight-normal text-white m-0" style="letter-spacing: 2px;">
                                             Kami Akan Menikah
                                        </h3>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Carousel End -->

     <!-- About Start -->
     <div class="container-fluid py-5" id="about">
          <div class="container py-5">
               <div class="section-title position-relative text-center">
                    <h1 class="font-secondary display-4">Pengantin Pria & Wanita</h1>
                    <i class="far fa-heart text-dark"></i>
               </div>
               <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0 flex-wrap-reverse">
                    <div class="col-md-6 p-0 text-center text-md-right">
                         <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                              <h3 class="mb-3">Pengantin Pria</h3>
                              <div><?= html_entity_decode($e->desc_man) ?></div>
                              <h3 class="font-secondary font-weight-normal text-capitalize text-muted mb-3">
                                   <i class="fa fa-male text-primary pr-3"></i><?= $e->name_man ?>
                              </h3>
                         </div>
                    </div>
                    <div class="col-md-6 p-0" style="min-height: 400px;">
                         <img class="position-absolute w-100 h-100" src="<?= base_url("$dir_img/profile/$e->image_man") ?>" style="object-fit: cover;">
                    </div>
               </div>
               <div class="row m-0">
                    <div class="col-md-6 p-0" style="min-height: 400px;">
                         <img class="position-absolute w-100 h-100" src="<?= base_url("$dir_img/profile/$e->image_woman") ?>" style="object-fit: cover;">
                    </div>
                    <div class="col-md-6 p-0 text-center text-md-left">
                         <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                              <h3 class="mb-3">Pengantin Wanita</h3>
                              <div><?= html_entity_decode($e->desc_woman) ?></div>
                              <h3 class="font-secondary font-weight-normal text-capitalize text-muted mb-3">
                                   <i class="fa fa-female text-primary pr-3"></i><?= $e->name_woman ?>
                              </h3>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- About End -->

     <!-- Story Start -->
     <div class="container-fluid py-5" id="story">
          <div class="container pt-5 pb-3">
               <div class="section-title position-relative text-center">
                    <h1 class="font-secondary display-4">Kisah Cinta Kami</h1>
                    <i class="far fa-heart text-dark"></i>
               </div>
               <div class="container timeline position-relative p-0">
                    <?php foreach ($love_story as $i => $ls): ?>
                         <div class="row align-items-md-center gap-md-3 <?= !$ls->position ? 'flex-row-reverse' : '' ?>">
                              <div class="col-md-6 text-center">
                                   <i class="<?= !$ls->position ? 'far fa-heart' : 'fas fa-hand-holding-heart' ?> text-primary font-large-5"></i>
                                   <!-- <img class="img-fluid mr-md-3" src="<?= base_url($dir_img . '/story-1.jpg') ?>" alt=""> -->
                              </div>
                              <div class="col-md-6 text-center <?= !$ls->position ? 'text-md-right' : 'text-md-left' ?>">
                                   <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4 ml-md-3">
                                        <h4 class="mb-2"><?= $ls->title ?></h4>
                                        <div class="m-0">
                                             <?= html_entity_decode($ls->body) ?>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <?php endforeach; ?>
               </div>
          </div>
     </div>
     <!-- Story End -->

     <!-- Gallery Start -->
     <div class="container-fluid bg-gallery" id="gallery" style="padding: 120px 0; margin: 90px 0;">
          <div class="section-title position-relative text-center" style="margin-bottom: 120px;">
               <h1 class="font-secondary display-4 text-white">Galeri Foto Kami</h1>
               <i class="far fa-heart text-white"></i>
          </div>
          <div class="owl-carousel gallery-carousel">
               <div class="gallery-item">
                    <img class="img-fluid w-100" src="<?= base_url($dir_img . '/gallery-1.jpg') ?>" alt="">
                    <a href="<?= base_url($dir_img . '/gallery-1.jpg') ?>" data-lightbox="gallery">
                         <i class="fa fa-2x fa-plus text-white"></i>
                    </a>
               </div>
               <div class="gallery-item">
                    <img class="img-fluid w-100" src="<?= base_url($dir_img . '/gallery-2.jpg') ?>" alt="">
                    <a href="<?= base_url($dir_img . '/gallery-2.jpg') ?>" data-lightbox="gallery">
                         <i class="fa fa-2x fa-plus text-white"></i>
                    </a>
               </div>
               <div class="gallery-item">
                    <img class="img-fluid w-100" src="<?= base_url($dir_img . '/gallery-3.jpg') ?>" alt="">
                    <a href="<?= base_url($dir_img . '/gallery-3.jpg') ?>" data-lightbox="gallery">
                         <i class="fa fa-2x fa-plus text-white"></i>
                    </a>
               </div>
               <div class="gallery-item">
                    <img class="img-fluid w-100" src="<?= base_url($dir_img . '/gallery-4.jpg') ?>" alt="">
                    <a href="<?= base_url($dir_img . '/gallery-4.jpg') ?>" data-lightbox="gallery">
                         <i class="fa fa-2x fa-plus text-white"></i>
                    </a>
               </div>
               <div class="gallery-item">
                    <img class="img-fluid w-100" src="<?= base_url($dir_img . '/gallery-5.jpg') ?>" alt="">
                    <a href="<?= base_url($dir_img . '/gallery-5.jpg') ?>" data-lightbox="gallery">
                         <i class="fa fa-2x fa-plus text-white"></i>
                    </a>
               </div>
               <div class="gallery-item">
                    <img class="img-fluid w-100" src="<?= base_url($dir_img . '/gallery-6.jpg') ?>" alt="">
                    <a href="<?= base_url($dir_img . '/gallery-6.jpg') ?>" data-lightbox="gallery">
                         <i class="fa fa-2x fa-plus text-white"></i>
                    </a>
               </div>
          </div>
     </div>
     <!-- Gallery End -->

     <!-- Event Start -->
     <div class="container-fluid py-5" id="event">
          <div class="container py-5">
               <div class="section-title position-relative text-center">
                    <h1 class="font-secondary display-4">Detail Acara</h1>
                    <i class="far fa-heart text-dark"></i>
               </div>
               <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                         <h5 class="font-weight-normal text-muted mb-3 pb-3">
                              Kegiatan ini Insya Allah akan dilaksanakan pada :
                         </h5>
                    </div>
               </div>
               <div class="row justify-content-center">
                    <div class="col-md-5 border border-primary rounded">
                         <div class="text-center">
                              <h1 class="text-center my-3">Akad Nikah</h1>
                              <div class="header my-3">
                                   <div class="section-title position-relative text-center mb-3">
                                        <i class="far fa-heart text-dark"></i>
                                   </div>
                                   <h1 class="font-secondary display-5"><?= nameDate($e->reception_date) ?></h1>
                                   <h1 class="font-secondary display-5"><?= date_indo(getDates('date', $e->reception_date)) ?></h1>
                                   <div class="section-title position-relative text-center">
                                        <i class="far fa-heart text-dark"></i>
                                   </div>
                              </div>
                              <div class="mb-2"><?= html_entity_decode($e->wedding_location) ?></div>
                              <div class="mb-3"><?= getDates('time', $e->wedding_date) ?> WIB - Selesai</div>
                         </div>
                    </div>
                    <div class="mx-3 my-5"></div>
                    <div class="col-md-5 border border-primary rounded">
                         <div class="text-center">
                              <h1 class="my-3">Resepsi</h1>
                              <div class="header my-3">
                                   <div class="section-title position-relative text-center mb-3">
                                        <i class="far fa-heart text-dark"></i>
                                   </div>
                                   <h1 class="font-secondary display-5"><?= nameDate($e->reception_date) ?></h1>
                                   <h1 class="font-secondary display-5"><?= date_indo(getDates('date', $e->reception_date)) ?></h1>
                                   <div class="section-title position-relative text-center">
                                        <i class="far fa-heart text-dark"></i>
                                   </div>
                              </div>
                              <div class="mb-2"><?= html_entity_decode($e->reception_location) ?></div>
                              <div class="mb-3"><?= getDates('time', $e->reception_date) ?> WIB - Selesai</div>
                         </div>
                    </div>
               </div>
               <div class="row justify-content-center">
                    <div class="col-12 my-5">
                         <h1 class="display-4 text-center mb-3">Maps</h1>
                         <div class="wedding-map"><?= html_entity_decode($e->wedding_map) ?></div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Event End -->

     <!-- Friends & Family Start -->
     <div class="container-fluid py-5" id="family">
          <div class="container pt-5 pb-3">
               <div class="section-title position-relative text-center">
                    <h1 class="font-secondary display-4">Friend & Family</h1>
                    <i class="far fa-heart text-dark"></i>
               </div>
               <div class="row">
                    <div class="col-12 text-center mb-2">
                         <ul class="list-inline mb-4" id="portfolio-flters">
                         <li class="btn btn-outline-primary font-weight-bold m-1 py-2 px-4" data-filter=".first">Groomsmen</li>
                         <li class="btn btn-outline-primary font-weight-bold m-1 py-2 px-4" data-filter=".second">Bridesmaid</li>
                         </ul>
                    </div>
               </div>
               <div class="row portfolio-container">
                    <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
                         <div class="position-relative mb-2">
                              <img class="img-fluid w-100" src="<?= base_url($dir_img . '/groomsmen-1.jpg') ?>" alt="">
                              <div class="bg-secondary text-center p-4">
                                   <h4 class="mb-3">Full Name</h4>
                                   <p class="text-uppercase">Best Friend</p>
                                   <div class="d-inline-block">
                                        <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 portfolio-item second">
                         <div class="position-relative mb-2">
                              <img class="img-fluid w-100" src="<?= base_url($dir_img . '/bridesmaid-1.jpg') ?>" alt="">
                              <div class="bg-secondary text-center p-4">
                                   <h4 class="mb-3">Full Name</h4>
                                   <p class="text-uppercase">Best Friend</p>
                                   <div class="d-inline-block">
                                        <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
                         <div class="position-relative mb-2">
                              <img class="img-fluid w-100" src="<?= base_url($dir_img . '/groomsmen-2.jpg') ?>" alt="">
                              <div class="bg-secondary text-center p-4">
                                   <h4 class="mb-3">Full Name</h4>
                                   <p class="text-uppercase">Best Friend</p>
                                   <div class="d-inline-block">
                                        <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 portfolio-item second">
                         <div class="position-relative mb-2">
                              <img class="img-fluid w-100" src="<?= base_url($dir_img . '/bridesmaid-2.jpg') ?>" alt="">
                              <div class="bg-secondary text-center p-4">
                                   <h4 class="mb-3">Full Name</h4>
                                   <p class="text-uppercase">Best Friend</p>
                                   <div class="d-inline-block">
                                        <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 portfolio-item first">
                         <div class="position-relative mb-2">
                              <img class="img-fluid w-100" src="<?= base_url($dir_img . '/groomsmen-3.jpg') ?>" alt="">
                              <div class="bg-secondary text-center p-4">
                                   <h4 class="mb-3">Full Name</h4>
                                   <p class="text-uppercase">Best Friend</p>
                                   <div class="d-inline-block">
                                        <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 portfolio-item second">
                         <div class="position-relative mb-2">
                              <img class="img-fluid w-100" src="<?= base_url($dir_img . '/bridesmaid-3.jpg') ?>" alt="">
                              <div class="bg-secondary text-center p-4">
                                   <h4 class="mb-3">Full Name</h4>
                                   <p class="text-uppercase">Best Friend</p>
                                   <div class="d-inline-block">
                                        <a class="mx-2" href="#"><i class="fab fa-twitter"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a class="mx-2" href="#"><i class="fab fa-instagram"></i></a>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Friends & Family End -->

     <!-- RSVP Start -->
     <div class="container-fluid py-5" id="rsvp">
          <div class="container py-5">
               <div class="section-title position-relative text-center">
                    <h1 class="font-secondary display-4">Bergabung dalam resepsi kami</h1>
                    <i class="far fa-heart text-dark"></i>
               </div>
               <div class="row justify-content-center">
                    <div class="col-lg-8">
                         <div class="text-center">
                         <form>
                              <div class="form-row">
                                   <div class="form-group col-sm-6">
                                        <input type="text" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Your Name"/>
                                   </div>
                                   <div class="form-group col-sm-6">
                                        <input type="email" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Your Email"/>
                                   </div>
                              </div>
                              <div class="form-row">
                                   <div class="form-group col-sm-6">
                                        <select class="form-control bg-secondary border-0" style="height: 52px;">
                                             <option>Number of Guest</option>
                                             <option>1</option>
                                             <option>2</option>
                                             <option>3</option>
                                             <option>4</option>
                                        </select>
                                   </div>
                                   <div class="form-group col-sm-6">
                                        <select class="form-control bg-secondary border-0" style="height: 52px;">
                                             <option>I'm Attending</option>
                                             <option>All Events</option>
                                             <option>Wedding Party</option>
                                        </select>
                                   </div>
                              </div>
                              <div class="form-group">
                                   <textarea class="form-control bg-secondary border-0 py-2 px-3" rows="5" placeholder="Message" required="required"></textarea>
                              </div>
                              <div>
                                   <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit">Submit</button>
                              </div>
                         </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- RSVP End -->

     <?php $this->load->view('templates/frontend/js.php') ?>
</body>
</html>