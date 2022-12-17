<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title><?= $judul ?></title>

     <!-- Icon -->
     <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/public/images/apple-touch-icon.png') ?>">
     <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/public/images/favicon-32x32.png') ?>">
     <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/public/images/favicon-16x16.png') ?>">
     <link rel="manifest" href="<?= base_url('assets/public/images/site.webmanifest') ?>">

     <?php $this->load->view("templates/admin/source_css") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed <?= tema() ?>">
     
     <!-- flash data -->
     <div id="flash-data" data-flash="<?= $this->session->flashdata('message') ?>">
     </div>

     <!-- wrapper -->
     <div class="wrapper">
          <?php
               #modal popup 
               $this->load->view("templates/admin/modal");

               #navbar 
               $this->load->view("templates/admin/navbar");

               #sidebar
               $this->load->view("templates/admin/sidebar");
          ?>

          <!-- content-wrapper -->
          <div class="content-wrapper">
               <?php
                    #breadcumb
                    $this->load->view("templates/admin/breadcumb");

                    #content
                    $this->load->view($content);
               ?>
          </div>

          <!-- Main Footer -->
          <?php $this->load->view('templates/admin/footer'); ?>
     </div>

     <?php $this->load->view("templates/admin/source_js"); ?>
</body>

</html>