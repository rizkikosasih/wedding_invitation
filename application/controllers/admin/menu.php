<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class menu extends CI_Controller {
     private $table = "menu";
     private $url;

     public function __construct() {
          parent::__construct();
          $this->load->model([
               'm_menu',
               'm_grup',
               'm_user',
               'm_master',
          ]);
          $this->url = 'admin/' . $this->uri->segment(2);
          cek_login();
     }

     public function index() {
          $data = [
               'user' => users(),
               "content" => "$this->url/index",
               'judul' => 'Data Menu',
               'curMenu' => 'Website',
               "url" => $this->url,
               'thead' => [
                    "No",
                    "Menu Utama",
                    "Nama Menu",
                    "Urutan",
                    "Icon",
                    "Url",
                    "Tipe",
                    "Aktif",
                    "Wajib Login",
                    "Aksi",
               ],
          ];

          $this->load->view('templates/admin/main-app', $data);
     } 

     public function modal($action, $id=null) {
          $akses = $this->m_menu->get_akses(array(
               "menu_id" => $id
          ))->result();
          $list_akses = [];
          foreach( $akses as $a ){
               $list_akses[] = $a->grup_id;
          }
          $grup = $this->m_grup->get(array(
               "id !=" => 4
          ))->result();
          $parent_menu = $this->m_menu->get(array(
               "induk_id" => 0
          ))->result();

          $data = [
               "this_data" => $this->m_menu->get(array(
                    "id" => $id,
               ))->row(),
               "tipe" => array( 
                    "b", 
                    "f", 
               ),
               "parent_menu" => $parent_menu,
               "grup" => $grup,
               "list_akses" => $list_akses,
               "url" => $this->url,
               "action" => $action,
          ];

          $this->load->view("$this->url/modals", $data);
          // $this->load->view("templates/admin/script_js");
     } 

     public function allData() {
          $result = $this->m_menu->allData();
          $data = [];
          $nomor = $this->input->post('start');

          foreach ($result as $row) {
               $tBtn = $row->isActive == 1 ? "Aktif" : "Non-Aktif";
               $icon = $row->isActive == 1 ? "fa-check text-success" : "fa-times text-danger";
               $msg = $row->isActive == 1 ? "Yakin mau dinonaktifkan?" : "Yakin mau diaktifkan?";
               $ilogin = $row->isLogin == 1 ? "fa-check text-success" : "fa-times text-danger";
               $ntipe = $row->tipe == 'b' ? "Backend" : "Frontend";
               $menu_utama = !$row->menu_utama ? "Parent Menu" : $row->menu_utama;

               $rows[] = [ 
                    '<div class="text-center">'.++$nomor.'</div>', 
                    $menu_utama, 
                    $row->nama_menu, 
                    "<div class='text-center'>$row->urutan</div>", 
                    "
                    <div class='text-center'>
                         <i class='title $row->icon' title='$row->icon'></i>
                    </div>
                    ", 
                    "<div class='text-center'>$row->url</div>",
                    "<div class='text-center'>$ntipe</div>",
                    '<div class="text-center">
                         <a 
                              href="javascript:void(0)" 
                              class="title status-side" 
                              title='.$tBtn.' 
                              data-status="'.$row->isActive.'" 
                              data-message="'.$msg.'" 
                              data-url="'.base_url("$this->url/aktifasi/").'" 
                              data-id="'.encode64($row->id).'" 
                              data-code="'.$row->isActive.'" 
                         >
                              <i class="fas '.$icon.'"></i>
                         </a>
                    </div>',
                    '<div class="text-center">
                         <a 
                              href="javascript:void(0)" 
                              class="title status-sides" 
                              data-message="Aktifasi Wajib Login"
                              data-url="'. base_url("$this->url/need_login/") .'" 
                              data-id="'.encode64($row->id).'" 
                              data-code="'.$row->isLogin.'" 
                         >
                              <i class="fas '.$ilogin.'"></i>
                         </a>
                    </div>',
                    '<div class="text-center">
                         <div class="btn-group">
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-primary title openPopup" 
                                   data-url="'. base_url("$this->url/modal/edit") .'" 
                                   data-id="'. $row->id .'" 
                                   data-style="animated slideInDown"
                                   title="Ubah Data"
                              >
                                   <i class="fas fa-edit"></i>
                              </a>
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-warning title openPopup" 
                                   data-url="'. base_url("$this->url/modal/tag_akses") .'" 
                                   data-id="'. $row->id .'" 
                                   data-style="modal-lg animated slideInDown"
                                   title="Ubah Akses Menu"
                              >
                                   <i class="fas fa-tag"></i>
                              </a>
                              
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-danger title delete-side" 
                                   data-message="Yakin mau dihapus ?"
                                   title="Hapus Data" 
                                   data-url="'. base_url("$this->url/delete/") .'"
                                   data-id="'.encode64($row->id).'"
                              >
                                   <i class="fas fa-trash"></i>
                              </a> 
                              
                         </div>
                    </div>'
               ];

               $data = $rows;
          }

          $output = [
               "draw" => intval($this->input->post('draw')),
               "recordsTotal" => intval($this->m_menu->countAllData()),
               "recordsFiltered" => intval($this->m_menu->countFilterData()),
               "data" => $data,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($output))
          ->set_status_header(200);
     }

     public function add() {
          $induk_id = $this->input->post('induk_id');
          $indukId = empty($induk_id) ? 0 : $induk_id;
          $data = [
               "nama_menu" => ucwords($this->input->post('nama_menu')),
               "icon" => $this->input->post('icon'),
               "url" => $this->input->post('url'),
               "urutan" => $this->input->post('urutan'),
               "tipe" => $this->input->post('tipe'),
               "induk_id" => $indukId,
          ];

          $this->m_master->add($this->table, $data);
          $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => "Berhasil menambahkan menu baru !",
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function edit() {
          $id = $this->input->post('id');
          $induk_id = empty($this->input->post('induk_id')) ? 0 : $this->input->post('induk_id');
          $data = [
               "nama_menu" => ucwords($this->input->post('nama_menu')),
               "icon" => $this->input->post('icon'),
               "url" => $this->input->post('url'),
               "urutan" => $this->input->post('urutan'),
               "tipe" => $this->input->post('tipe'),
               "induk_id" => $induk_id,
          ];
          $this->m_master->update($this->table,['id' => $id], $data);

          $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => "Menu berhasil diperbarui !",
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function delete() {
          $where = [
               'id' => decode64($this->input->post('id'))
          ];
          $data = [
               'isDelete' => 1
          ];
          if ( $this->m_master->update($this->table, $where, $data) > 0 ) {
               $result = [
                    "response" => 200,
                    "status" => "SUKSES",
                    "message" => "Menu telah dihapus !",
               ];
          } else {
               $result = [
                    "response" => 500,
                    "status" => "GAGAL",
                    "message" => "Menu Gagal Dihapus !",
               ];
          }

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function aktifasi() {
          $id = decode64($this->input->post('id'));
          $code = $this->input->post('code');
          $nCode = $code == 1 ? 0 : 1;
          $message = $code == 1 ? "Menu Berhasil Dinonaktifkan!" : "Menu Berhasil Diaktifkan!";
          $data = [
               'isActive' => $nCode
          ];
          $this->m_master->update( $this->table, [ 
               'id' => $id 
          ], $data );

          $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => $message,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function need_login() {
          $id = decode64($this->input->post('id'));
          $code = $this->input->post('code');
          $nCode = $code == 1 ? 0 : 1;
          $message = $code == 1 ? "Need Login Dinonaktifkan!" : "Need Login Diaktifkan!";
          $data = [
               'isLogin' => $nCode
          ];
          $this->m_master->update( $this->table, [ 
               'id' => $id 
          ], $data );

          $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => $message,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function tag_akses() {
          $where = [
               'menu_id' => $this->input->post('menu_id'),
               'grup_id' => $this->input->post('grup_id'),
          ];
          $akses_menu = $this->m_menu->get_akses($where)->num_rows();
          if ( $akses_menu > 0 ) {
               #delete akses
               $this->m_master->delete('akses_menu',$where);
               $result = [
                    "response" => 200,
                    "message" => "Akses Berhasil Dihapus !"
               ];
          } else {
               #add akses
               $this->m_master->add('akses_menu',$where);
               $result = [
                    "response" => 200,
                    "message" => "Akses Berhasil Ditambahkan !"
               ];
          }

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header('200');
     }
     
}