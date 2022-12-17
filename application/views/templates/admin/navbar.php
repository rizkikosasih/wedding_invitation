<?php
     #src image profile
     $path = "assets/backend/dist/img/profile/";
     $src = $user->foto != '' ? base_url($path . $user->foto) : base_url($path . 'default.png');
     $tema = $user->tema;
     $_ck = $tema == 'dark-mode' ? 'checked="checked"' : '';
?>
<!-- Navbar -->
<nav id='top-nav' class="main-header navbar navbar-expand navbar-dark navbar-navy">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
          <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
               </a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
               <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">Home</a>
          </li> 
          <li class="nav-item d-none d-sm-inline-block">
               <div class="nav-link">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                         <input 
                              type="checkbox" 
                              class="custom-control-input" 
                              id="switch-theme" 
                              data-href="<?= base_url('admin/user/update_tema') ?>" 
                              data-tema='<?= $tema ?>' 
                              <?= $_ck ?>
                         >
                         <label class="custom-control-label" for="switch-theme"><i class="fas fa-adjust title" title="Switch Mode"></i></label>
                    </div>
               </div>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
               <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
               </a>
          </li>
     </ul>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
          <!-- logout -->
          <li class="nav-item dropdown no-arrow">
               <a class="nav-link dropdown-toggle image no-arrow" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                    <img src="<?= $src ?>" class="img-fluid img-rounded img-profile" alt="User Image">
                    <span class='ml-1'><?= $user->nama ?></span>
               </a>
               <div class="dropdown-menu font-small-3" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?= base_url('admin/user/profile') ?>">
                         <i class="fas fa-user-circle mr-2"></i>Profile Saya
                    </a>
                    <a class="dropdown-item" href="<?= base_url('admin/user/ubah_password') ?>">
                         <i class="fas fa-key mr-2"></i>Ubah Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#logout">
                         <i class="fas fa-power-off mr-2"></i>Logout
                    </a>
               </div>
          </li>
     </ul>
</nav>
<!-- /.navbar -->