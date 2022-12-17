<?php
     $path = "assets/backend/dist/img/profile/";
     $pathThis = "assets/backend/dist/img/halaman/b/";
     $src = !empty($user->foto) ? $src = base_url($path . $user->foto) : base_url($path . 'default.png');

     $fontsize = strlen(strip_tags(statis('b','logo-txt'))) >= 16 ? "font-size:12pt;" : "";
     $textLogo = strip_tags(statis('b','logo-txt'));
     $text = explode(' ', $textLogo);
     if( count($text) > 2 ){
          $logoTxt = "<span class='text-danger'>$text[0] $text[1]</span> ";
          for( $i = 2; $i < count($text); $i++ ){
               $logoTxt .= "<span class='".tema('txt')."'>$text[$i]</span> ";
          }
     } else {
          $logoTxt = $textLogo;
     }

?>

<!-- Main Sidebar Container -->
<aside id='main-sidebar' class="main-sidebar <?= tema('sidebar') ?> elevation-4">
     
     <!-- Brand Logo -->
     <a href="<?= base_url('admin/dashboard') ?>" class="brand-link <?= tema('navbar') ?>">
          <img src="<?= base_url($pathThis . statis('b','logo-icon')) ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
     
          <div class="ml-3">
               <span class="brand-text font-weight-bold ml-1 mt-0" style="<?= $fontsize ?>">
                    <?= $logoTxt ?>
               </span>
          </div>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
     
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">

               <div class="image">
                    <img src="<?= $src ?>" class="img-fluid img-rounded" alt="User Image">
               </div>

               <div class="info">
                    <a href="<?= base_url('admin/user/profile') ?>" class="text-capitalize d-block"><?= $user->nama ?></a>
               </div>
               
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
               
                    <?= loadMenuBackend($curMenu,$judul) ?>

                    <li class="nav-item">
                         <a href="javascript:void(0);" data-toggle="modal" data-target="#logout" class="nav-link">
                              <i class="nav-icon fas fa-sign-out-alt"></i>
                              <p>Logout</p>
                         </a>
                    </li>

               </ul>
          </nav>
          <!-- /.sidebar-menu -->

     </div>
     <!-- /.sidebar -->
</aside>