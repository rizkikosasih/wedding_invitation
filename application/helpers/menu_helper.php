<?php
     function loadMenuBackend($curMenu) {
          $ci =& get_instance();
          $curl = $ci->uri->segment(2);
          $ci->load->model([
               "m_menu",
          ]);
          $usr = users();
          $grup_id = $usr->grup_id;
          $whereM = [
               "m.isActive" => 1,
               "m.tipe" => "b",
               "am.grup_id" => $grup_id,
               "m.induk_id" => 0,
               "m.isDelete" => 0,
          ];
          $menu = $ci->m_menu->menuBack($whereM)->result();
          $output = "";
          foreach( $menu as $m ):
               $menuId = $m->id;
               $whereSM = [
                    "m.isActive" => 1,
                    "m.tipe" => "b",
                    "am.grup_id" => $grup_id,
                    "m.induk_id" => $menuId,
                    "m.isDelete" => 0,
               ];
               $submenu = $ci->m_menu->menuBack($whereSM)->result();
               $activeM = $m->nama_menu == $curMenu ? "active" : "";
               if( $m->url == "#" ){
                    $openM = $m->nama_menu == $curMenu ? "menu-is-opening menu-open" : "";
                    $iconM = "<i class=\"right fas fa-angle-left\"></i>";
               }else{
                    $openM = "";
                    $iconM = "";
               }
               $urlMenu = $m->url == '#' ? 'javascript:void(0);' : base_url('admin/' . $m->url);
               $output .= "
               <li class=\"nav-item $openM\">
                    <a href='$urlMenu' class=\"nav-link $activeM\">
                         <i class=\"nav-icon $m->icon\"></i>
                         <p>
                              $m->nama_menu
                              $iconM
                         </p>
                    </a>
               ";
               if( isset($submenu) ):
                    foreach ($submenu as $sm):
                         $activeSM = $sm->url == $curl ? "active font-weight-bold" : "";
                         $output .= "
                         <ul class=\"nav nav-treeview\">
                              <li class=\"nav-item\">
                                   <a href='". base_url('admin/' . $sm->url) ."' class=\"nav-link $activeSM\">
                                        <i class=\"nav-icon $sm->icon\"></i>
                                        <p>$sm->nama_menu</p>
                                   </a>
                              </li>
                         </ul>
                         ";
                    endforeach;
               endif;
               $output .= "</li>";
          endforeach;

          return $output;
     }

     function loadMenuFrontend($curMenu="", $judul=null) {
          $ci =& get_instance();
          $ci->load->model('m_menu');

          if( !empty($ci->session->userdata('id')) ){
               $whereMenu = [
                    "id != 12 AND id != 13 AND id !=" => 7,
                    "isActive" => 1,
                    "tipe" => "f",
               ];
          }else{
               $whereMenu = [
                    "isLogin" => 0,
                    "isActive" => 1,
                    "tipe" => "f",
               ];
          }

          $menu = $ci->m_menu->menuFront($whereMenu)->result();
          $pecah = explode(' ', strip_tags(statis('b','logo-txt')) );
          $j = count($pecah);

          if( $j > 2 ){
               $txt = "<span class=\"text-primary\">$pecah[0] $pecah[1]</span>";

               for( $i = 2; $i < $j; $i++ ):
                    $txt .= "<span class=\"text-dark\"> $pecah[$i]</span>";
               endfor;
          }else{
               $txt .= "<span class=\"text-primary\">$pecah[0]</span>";

               for( $i = 1; $i < $j; $i++ ):
                    $txt .= "<span class=\"text-dark\"> $pecah[$i]</span>";
               endfor;
          }

          $output = "
               <!-- Navbar Start -->
               <div class=\"container-fluid p-0\">
                    <nav class=\"navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5\">
                         <a href=".base_url()." class=\"navbar-brand ml-lg-3\">
                              <h5 class=\"m-0\">
                                   <span class=\"text-dark\">
                                        <img src=". base_url('assets/backend/dist/img/halaman/b/'.statis('b','logo-icon')) ." alt=\"\" style=\"width:45px;height:45px;\">
                                   </span> 
                                   $txt
                              </h5>
                         </a>
                         <button type=\"button\" class=\"navbar-toggler\" data-toggle=\"collapse\" data-target=\"#navbarCollapse\">
                              <span class=\"navbar-toggler-icon\"></span>
                         </button>
                         <div class=\"collapse navbar-collapse justify-content-between px-lg-3\" id=\"navbarCollapse\">
                              <div class=\"navbar-nav ml-auto py-0\">";
                                   foreach ($menu as $m) {
                                        # code...
                                        $active = strtolower($curMenu) == strtolower($m->nama_menu) ? "active" : "";
                                        $url = $m->url == 'home' ? "" : $m->url;
                                        $output .= "
                                             <a href='".base_url($url)."' class=\"nav-item nav-link $active\">$m->nama_menu</a>
                                        ";
                                   }
                         $output .= "
                              </div>
                         </div>
                    </nav>
               </div>
               <!-- Navbar End -->
          ";

          return $output;
     }

     function loadMenuFooter() {
          $ci =& get_instance();
          $ci->load->model('m_menu');

          if( !empty($ci->session->userdata('id')) ){
               $whereMenu = [
                    "id != 12 AND id != 13 AND id !=" => 7,
                    "isActive" => 1,
                    "tipe" => "f",
               ];
          }else{
               $whereMenu = [
                    "isLogin" => 0,
                    "isActive" => 1,
                    "tipe" => "f",
               ];
          }

          $menu = $ci->m_menu->menuFront($whereMenu)->result();
          
          $output = '';

          foreach($menu as $m):
               #code
               $url = $m->url == 'home' ? "" : $m->url;
               $output .= "
               <a class=\"text-white-50 mb-2\" href='".base_url($url)."'>
                    <i class=\"fa fa-angle-right mr-2\"></i>$m->nama_menu
               </a>
               ";
          endforeach;

          return $output;
     }