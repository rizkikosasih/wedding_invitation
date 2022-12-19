<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
     <meta http-equiv="Pragma" content="no-cache">
     <meta http-equiv="Expires" content="0">
     <title><?= $judul ?></title>
     <!-- Icon -->
     <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/public/images/apple-touch-icon.png') ?>">
     <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/public/images/favicon-32x32.png') ?>">
     <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/public/images/favicon-16x16.png') ?>">
     <link rel="manifest" href="<?= base_url('assets/public/images/site.webmanifest') ?>">
     <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
     <!-- Font Awesome -->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
     <!-- icheck bootstrap -->
     <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
     <!-- Toastr -->
     <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/toastr/toastr.min.css">
     <!-- Theme style -->
     <link rel="stylesheet" href="<?= base_url(); ?>assets/backend/dist/css/adminlte.min.css">
     <!-- Animate -->
     <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/animate/animate-3.5.2.css">
     <!-- custom style -->
     <link rel="stylesheet" href="<?= base_url(); ?>assets/backend/custom/css/custom_auth.css">

     <style>
          body {
               background-image: url('<?= base_url('assets/backend/dist/img/halaman/b/'.statis('b','bg-login')); ?>');
               background-size: cover;
               background-repeat: no-repeat;
               background-position: center center;
               min-height: 100%;
          }
     </style>

</head>

<body class="hold-transition login-page">

     <div id="flash-data" data-flash="<?= $this->session->flashdata('message') ?>">
     </div>

     <div class="login-box">
          <div class="card card-outline card-primary">
               <div class="card-header text-center mt-2">
                    <h2 class="font-weight-bold">
                         <?= $judul ?>
                    </h2>
                    <?php 
                         if( isset($result) ){ 
                              if( $result == 200 ){
                                   echo "<h5>Berhasil</h5>";
                              }else{
                                   echo "<h5>Gagal</h5>";
                              }
                         } 
                    ?>
               </div>

               <div class="card-body">
                    <?php $this->load->view($content) ?>
               </div>
               <!-- /.card-body -->

          </div>
          <!-- /.card -->
     </div>
     <!-- /.regis-login-box -->

     <!-- jQuery -->
     <script src="<?= base_url('assets/plugins/jquery/jquery.js'); ?>"></script>
     <!-- jQuery UI 1.11.4 -->
     <script src="<?= base_url('assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
     <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
     <script>
          $.widget.bridge('uibutton', $.ui.button)
     </script>
     <!-- Bootstrap 4 -->
     <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
     <!-- ChartJS -->
     <script src="<?= base_url('assets/plugins/chart.js/Chart.min.js'); ?>"></script>
     <!-- JQVMap -->
     <script src="<?= base_url('assets/plugins/jqvmap/jquery.vmap.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js'); ?>"></script>
     <!-- jQuery Knob Chart -->
     <script src="<?= base_url('assets/plugins/jquery-knob/jquery.knob.min.js'); ?>"></script>
     <!-- daterangepicker -->
     <script src="<?= base_url('assets/plugins/moment/moment.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/daterangepicker/daterangepicker.js'); ?>"></script>
     <!-- Tempusdominus Bootstrap 4 -->
     <script src="<?= base_url('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>
     <!-- Summernote -->
     <script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
     <!-- overlayScrollbars -->
     <script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
     <!-- AdminLTE App -->
     <script src="<?= base_url('assets/backend/dist/js/adminlte.js'); ?>"></script>
     <!-- tail select -->
     <script src="<?= base_url('assets/plugins/tail.select/js/tail.select-full.min.js'); ?>"></script>
     <!-- Bootstrap4 Duallistbox -->
     <script src="<?= base_url('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js'); ?>"></script>
     <!-- bootstrap color picker -->
     <script src="<?= base_url('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js'); ?>"></script>
     <!-- Bootstrap Switch -->
     <script src="<?= base_url('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>"></script>
     <!-- BS-Stepper -->
     <script src="<?= base_url('assets/plugins/bs-stepper/js/bs-stepper.min.js'); ?>"></script>
     <!-- dropzonejs -->
     <script src="<?= base_url('assets/plugins/dropzone/min/dropzone.min.js'); ?>"></script>
     <!-- bs-custom-file -->
     <script src="<?= base_url('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>
     <!-- jquery-mask -->
     <script src="<?= base_url('assets/plugins/jquery-mask/jquery.mask.min.js'); ?>"></script>
     <!-- Isotope -->
     <script src="<?= base_url('assets/plugins/isotope/isotope.pkgd.min.js'); ?>"></script>
     <!-- SweetAlert2 -->
     <script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
     <!-- Toastr -->
     <script src="<?= base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
     <!-- Ekko LightBox -->
     <script src="<?= base_url('assets/plugins/ekko-lightbox/ekko-lightbox.min.js'); ?>"></script>
     <!-- WOW -->
     <script src="<?= base_url('assets/plugins/wow.js/dist/wow.min.js'); ?>"></script>
     <!-- Tinymce -->
     <script src="<?= base_url('assets/plugins/tinymce/tinymce.min.js'); ?>"></script>
     <!-- jquery-validation -->
     <script src="<?= base_url('assets/plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/jquery-validation/localization/messages_id.min.js'); ?>"></script>
     <!-- DataTables  & Plugins -->
     <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/jszip/jszip.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/pdfmake/pdfmake.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/pdfmake/vfs_fonts.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.html5.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.print.min.js'); ?>"></script>
     <script src="<?= base_url('assets/plugins/datatables-buttons/js/buttons.colVis.min.js'); ?>"></script>
     <!-- Custom JS -->
     <script src="<?= base_url('assets/backend/custom/js/index.js'); ?>"></script>

</body>
</html>