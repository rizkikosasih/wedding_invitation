<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class event extends CI_Controller {
     private $dir_img = 'assets/public/images';
     private $table = 'event';
     private $table_story = 'love_story';
     private $table_gallery = 'gallery';
     private $table_comment = 'comment';
     private $table_undangan_terkirim = 'undangan_terkirim';
     private $image_size = [300, 1920];
     private $image_name = ['x300_', 'x1920_'];
     private $url;

     public function __construct() {
          parent::__construct();
          $this->load->model(['m_user', 'm_menu', 'm_master', 'm_event']);
          $this->url = 'admin/' . $this->uri->segment(2);
          cek_login();
     }

     public function index() {
          $user = users();
          $event = $this->m_event->get(['event.id' => 1]);
          $data = [
               'user' => $user,
               "content" => "$this->url/index",
               'judul' => 'Event',
               'curMenu' => 'Administrator',
               "url" => $this->url, 
               "dir_img" => $this->dir_img, 
               "today" => date('Y-m-d'), 
               "e" => $event,
               'list_tab' => $this->m_event->tabList(),
               'list_bank' => $this->m_event->get_all_bank(),
          ];
          $this->load->view('templates/admin/main-app', $data);
     }

     public function modal($action, $id=null) {
          $explode = explode('-', $id);
          $index = $explode[0] != '' ? decode64($explode[0]) : null;
          $event_id = decode64($explode[1]);
          $data = [
               "this_story" => $this->m_event->get_story($index),
               "this_gallery" => $this->m_event->get_gallery($index),
               "url" => $this->url,
               "dir_img" => $this->dir_img,
               "action" => $action,
               "event_id" => $event_id,
          ];

          $this->load->view("$this->url/modals", $data);
     } 

     public function update_event() {
          $id = decode64($this->input->post('id'));
          $current = $this->m_event->get(['event.id' => $id]);
          $receptionDate = $this->input->post('reception_date');
          $receptionTime = date('H:i:s', strtotime($this->input->post('reception_time')));
          $weddingDate = $this->input->post('wedding_date');
          $weddingTime = date('H:i:s', strtotime($this->input->post('wedding_time')));
          $reception = $receptionDate . ' ' . $receptionTime;
          $wedding = $weddingDate . ' ' . $weddingTime;
          $image_man = $_FILES['image_man']['name'];
          $image_woman = $_FILES['image_woman']['name'];
          $cover = $_FILES['cover']['name'];
          $cover_mobile = $_FILES['cover_mobile']['name'];
          $background_home = $_FILES['background_home']['name'];
          $background_home_mobile = $_FILES['background_home_mobile']['name'];
          $background_gallery = $_FILES['background_gallery']['name'];
          $background_gallery_mobile = $_FILES['background_gallery_mobile']['name'];
          $wedding_map = $this->input->post('wedding_map') ? htmlentities($this->input->post('wedding_map')) : $current->wedding_map;
          $pathProfile = "$this->dir_img/profile/";
          $pathEvent = "$this->dir_img/event/";
          $image_config = [
               'name' => ['x300_', 'x1920_'],
               'size' => [300, 1920],
          ];
          $image_lib = $this->load->library('image_lib');

          //cek image
          if ($image_man) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => $pathProfile,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $image_man,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('image_man') ) {
                    if ($current->image_man) {
                         if (file_exists("$this->dir_img/profile/$current->image_man")) {
                              unlink(FCPATH . "$this->dir_img/profile/$current->image_man");
                         }
                         for ($i = 0; $i < count($image_config['name']); $i++) {
                              if (file_exists("$this->dir_img/profile/" . $image_config['name'][$i] . $current->image_man)) {
                                   unlink(FCPATH . "$this->dir_img/profile/" . $image_config['name'][$i] . $current->image_man);
                              }
                         }
                    }
                    $image_man = $this->upload->data('file_name');
                    for ($i = 0; $i < count($image_config['size']); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/profile/$image_man",
                              'new_image' => "$this->dir_img/profile/" . $image_config['name'][$i] . $image_man,
                              'maintain_ratio' => TRUE,
                              'width' => $image_config['size'][$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
               } else {
                    $image_man = '';
               }
          } else {
               $image_man = $current->image_man;
          }

          if ($image_woman) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => $pathProfile,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $image_woman,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('image_woman') ) {
                    if ($current->image_woman) {
                         if (file_exists("$this->dir_img/profile/$current->image_woman")) {
                              unlink(FCPATH . "$this->dir_img/profile/$current->image_woman");
                         }
                         for ($i = 0; $i < count($image_config['name']); $i++) {
                              if (file_exists("$this->dir_img/profile/" . $image_config['name'][$i] . $current->image_woman)) {
                                   unlink(FCPATH . "$this->dir_img/profile/" . $image_config['name'][$i] . $current->image_woman);
                              }
                         }
                    }
                    $image_woman = $this->upload->data('file_name');
                    for ($i = 0; $i < count($image_config['size']); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/profile/$image_woman",
                              'new_image' => "$this->dir_img/profile/" . $image_config['name'][$i] . $image_woman,
                              'maintain_ratio' => TRUE,
                              'width' => $image_config['size'][$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
               } else {
                    $image_woman = '';
               }
          } else {
               $image_woman = $current->image_woman;
          }

          if ($cover) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => $pathEvent,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $cover,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('cover') ) {
                    if ($current->cover) {
                         if (file_exists("$this->dir_img/event/$current->cover")) {
                              unlink(FCPATH . "$this->dir_img/event/$current->cover");
                         }
                         for ($i = 0; $i < count($image_config['name']); $i++) {
                              if (file_exists("$this->dir_img/event/" . $image_config['name'][$i] . $current->cover)) {
                                   unlink(FCPATH . "$this->dir_img/event/" . $image_config['name'][$i] . $current->cover);
                              }
                         }
                    }
                    $cover = $this->upload->data('file_name');
                    for ($i = 0; $i < count($image_config['size']); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/event/$cover",
                              'new_image' => "$this->dir_img/event/" . $image_config['name'][$i] . $cover,
                              'maintain_ratio' => TRUE,
                              'width' => $image_config['size'][$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
               } else {
                    $cover = '';
               }
          } else {
               $cover = $current->cover;
          }

          if ($cover_mobile) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => $pathEvent,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $cover_mobile,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('cover_mobile') ) {
                    if ($current->cover_mobile) {
                         if (file_exists("$this->dir_img/event/$current->cover_mobile")) {
                              unlink(FCPATH . "$this->dir_img/event/$current->cover_mobile");
                         }
                         for ($i = 0; $i < count($image_config['name']); $i++) {
                              if (file_exists("$this->dir_img/event/" . $image_config['name'][$i] . $current->cover_mobile)) {
                                   unlink(FCPATH . "$this->dir_img/event/" . $image_config['name'][$i] . $current->cover_mobile);
                              }
                         }
                    }
                    $cover_mobile = $this->upload->data('file_name');
                    for ($i = 0; $i < count($image_config['size']); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/event/$cover_mobile",
                              'new_image' => "$this->dir_img/event/" . $image_config['name'][$i] . $cover_mobile,
                              'maintain_ratio' => TRUE,
                              'width' => $image_config['size'][$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
               } else {
                    $cover_mobile = '';
               }
          } else {
               $cover_mobile = $current->cover_mobile;
          }

          if ($background_home) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => $pathEvent,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $background_home,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('background_home') ) {
                    if ($current->background_home) {
                         if (file_exists("$this->dir_img/event/$current->background_home")) {
                              unlink(FCPATH . "$this->dir_img/event/$current->background_home");
                         }
                         for ($i = 0; $i < count($image_config['name']); $i++) {
                              if (file_exists("$this->dir_img/event/" . $image_config['name'][$i] . $current->background_home)) {
                                   unlink(FCPATH . "$this->dir_img/event/" . $image_config['name'][$i] . $current->background_home);
                              }
                         }
                    }
                    $background_home = $this->upload->data('file_name');
                    for ($i = 0; $i < count($image_config['size']); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/event/$background_home",
                              'new_image' => "$this->dir_img/event/" . $image_config['name'][$i] . $background_home,
                              'maintain_ratio' => TRUE,
                              'width' => $image_config['size'][$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
               } else {
                    $background_home = '';
               }
          } else {
               $background_home = $current->background_home;
          }

          if ($background_home_mobile) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => $pathEvent,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $background_home_mobile,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('background_home_mobile') ) {
                    if ($current->background_home_mobile) {
                         if (file_exists("$this->dir_img/event/$current->background_home_mobile")) {
                              unlink(FCPATH . "$this->dir_img/event/$current->background_home_mobile");
                         }
                         for ($i = 0; $i < count($image_config['name']); $i++) {
                              if (file_exists("$this->dir_img/event/" . $image_config['name'][$i] . $current->background_home_mobile)) {
                                   unlink(FCPATH . "$this->dir_img/event/" . $image_config['name'][$i] . $current->background_home_mobile);
                              }
                         }
                    }
                    $background_home_mobile = $this->upload->data('file_name');
                    for ($i = 0; $i < count($image_config['size']); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/event/$background_home_mobile",
                              'new_image' => "$this->dir_img/event/" . $image_config['name'][$i] . $background_home_mobile,
                              'maintain_ratio' => TRUE,
                              'width' => $image_config['size'][$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
               } else {
                    $background_home_mobile = '';
               }
          } else {
               $background_home_mobile = $current->background_home_mobile;
          }

          if ($background_gallery) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => $pathEvent,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $background_gallery,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('background_gallery') ) {
                    if ($current->background_gallery) {
                         if (file_exists("$this->dir_img/event/$current->background_gallery")) {
                              unlink(FCPATH . "$this->dir_img/event/$current->background_gallery");
                         }
                         for ($i = 0; $i < count($image_config['name']); $i++) {
                              if (file_exists("$this->dir_img/event/" . $image_config['name'][$i] . $current->background_gallery)) {
                                   unlink(FCPATH . "$this->dir_img/event/" . $image_config['name'][$i] . $current->background_gallery);
                              }
                         }
                    }
                    $background_gallery = $this->upload->data('file_name');
                    for ($i = 0; $i < count($image_config['size']); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/event/$background_gallery",
                              'new_image' => "$this->dir_img/event/" . $image_config['name'][$i] . $background_gallery,
                              'maintain_ratio' => TRUE,
                              'width' => $image_config['size'][$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
               } else {
                    $background_gallery = '';
               }
          } else {
               $background_gallery = $current->background_gallery;
          }

          if ($background_gallery_mobile) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => $pathEvent,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $background_gallery_mobile,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('background_gallery_mobile') ) {
                    if ($current->background_gallery_mobile) {
                         if (file_exists("$this->dir_img/event/$current->background_gallery_mobile")) {
                              unlink(FCPATH . "$this->dir_img/event/$current->background_gallery_mobile");
                         }
                         for ($i = 0; $i < count($image_config['name']); $i++) {
                              if (file_exists("$this->dir_img/event/" . $image_config['name'][$i] . $current->background_gallery_mobile)) {
                                   unlink(FCPATH . "$this->dir_img/event/" . $image_config['name'][$i] . $current->background_gallery_mobile);
                              }
                         }
                    }
                    $background_gallery_mobile = $this->upload->data('file_name');
                    for ($i = 0; $i < count($image_config['size']); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/event/$background_gallery_mobile",
                              'new_image' => "$this->dir_img/event/" . $image_config['name'][$i] . $background_gallery_mobile,
                              'maintain_ratio' => TRUE,
                              'width' => $image_config['size'][$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
               } else {
                    $background_gallery_mobile = '';
               }
          } else {
               $background_gallery_mobile = $current->background_gallery_mobile;
          }

          $data = [
               'event_name' => $this->input->post('event_name'),
               'reception_date' => $reception,
               'wedding_date' => $wedding,
               'reception_location' => htmlentities($this->input->post('reception_location')),
               'wedding_location' => htmlentities($this->input->post('wedding_location')),
               'bank_id' => $this->input->post('bank_id'),
               'atas_nama' => $this->input->post('atas_nama'),
               'number_rekening' => $this->input->post('number_rekening'),
               'bank_id2' => $this->input->post('bank_id2'),
               'atas_nama2' => $this->input->post('atas_nama2'),
               'number_rekening2' => $this->input->post('number_rekening2'),
               'wedding_map' => $wedding_map,
               'name_man' => ucwords($this->input->post('name_man')),
               'alias_man' => ucwords($this->input->post('alias_man')),
               'desc_man' => htmlentities($this->input->post('desc_man')),
               'image_man' => $image_man,
               'name_woman' => ucwords($this->input->post('name_woman')),
               'alias_woman' => ucwords($this->input->post('alias_woman')),
               'desc_woman' => htmlentities($this->input->post('desc_woman')),
               'image_woman' => $image_woman,
               'cover' => $cover,
               'background_home' => $background_home,
               'background_gallery' => $background_gallery,
               'cover_mobile' => $cover_mobile,
               'background_home_mobile' => $background_home_mobile,
               'background_gallery_mobile' => $background_gallery_mobile,
               'wedding_map' => $wedding_map,
          ];
          $affected_row = $this->m_master->update($this->table, ['id' => $id], $data);

          $result = [
               'response' => 200,
               'message' => 'Berhasil Diupdate',
               'affected_row' => $affected_row,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function list_story($id) {
          $event_id = decode64($id);
          $result = $this->m_event->story(['event_id' => $event_id]);
          $data = [];
          $nomor = $this->input->post('start');
          foreach ($result as $row) {
               $position = $row->position ? 'right' : 'left';
               $rows[] = [ 
                    '<div class="text-center">'.++$nomor.'</div>', 
                    $row->title, 
                    html_entity_decode($row->body), 
                    '<div class="text-center">'.$row->sort.'</div>',
                    '<div class="text-center text-capitalize">'.$position.'</div>',
                    '<div class="text-center">
                         <div class="btn-group">
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-primary title openPopup" 
                                   data-url="'. base_url("$this->url/modal/edit_story") .'" 
                                   data-id="'. encode64($row->id) .'-'. encode64($event_id) .'" 
                                   data-style="animated slideInDown"
                                   title="Ubah Data"
                              >
                                   <i class="fas fa-edit"></i>
                              </a> 
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-danger title delete-side" 
                                   data-message="Yakin mau dihapus ?"
                                   title="Hapus Data" 
                                   data-url="'. base_url("$this->url/delete_story/") .'"
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
               "recordsTotal" => intval($this->m_event->count_all_story()),
               "recordsFiltered" => intval($this->m_event->count_story()),
               "data" => $data,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($output))
          ->set_status_header(200);
     }

     public function add_story() {
          $event_id = decode64($this->input->post('event_id'));
          $data = [
               'event_id' => $event_id,
               'title' => $this->input->post('title'),
               'body' => htmlentities($this->input->post('body')),
               'sort' => $this->input->post('sort'),
               'position' => $this->input->post('position'),
               'date_added' => date('Y-m-d H:i:s'),
          ];
          $tambah = $this->m_master->add($this->table_story, $data);
          $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => "Love Story berhasil ditambahkan !",
               "affected_row" => $tambah,
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function edit_story() {
          $id = decode64($this->input->post('id'));
          $event_id = decode64($this->input->post('event_id'));
          $data = [
               'event_id' => $event_id,
               'title' => $this->input->post('title'),
               'body' => htmlentities($this->input->post('body')),
               'sort' => $this->input->post('sort'),
               'position' => $this->input->post('position'),
          ];
          $updated = $this->m_master->update($this->table_story, ['id' => $id], $data);
          $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => "Love Story berhasil diperbarui !",
               "affected_row" => $updated,
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function delete_story() {
          $id = decode64($this->input->post('id'));
          $deleted = $this->m_master->update($this->table_story, ['id' => $id], ['isDelete' => 1]);
          $result = [
               'response' => 200,
               'status' => 'SUKSES',
               'message' => "Love Story Berhasil Dihapus!",
               'affected_row' => $deleted,
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function gallery($id) {
          $event_id = decode64($id);
          $result = $this->m_event->gallery(['event_id' => $event_id]);
          $data = [];
          $nomor = $this->input->post('start');
          foreach ($result as $row) {
               $tBtn = $row->isActive == 1 ? "Aktif" : "Non-Aktif";
               $msg = $row->isActive == 1 ? "Yakin mau dinonaktifkan?" : "Yakin mau diaktifkan?";
               $icon = $row->isActive == 1 ? "fa-check text-success" : "fa-times text-danger";
               $rows[] = [ 
                    '<div class="text-center">'.++$nomor.'</div>', 
                    '<div class="text-center">
                         <a class="lightbox title" href="'.base_url("$this->dir_img/gallery/x1920_$row->images").'" data-title="Image Gallery">
                              <img src="'.base_url("$this->dir_img/gallery/x300_$row->images").'" class="img-rounded" alt="" width="100" height="auto">
                         </a>
                    </div>', 
                    html_entity_decode($row->description), 
                    '<div class="text-center">
                         <a 
                              href="javascript:void(0)" 
                              class="title status-side" 
                              title='.$tBtn.' 
                              data-status="'.$row->isActive.'" 
                              data-message="'.$msg.'" 
                              data-url="'.base_url("$this->url/active_gallery/").'" 
                              data-id="'.encode64($row->id).'" 
                              data-code="'.$row->isActive.'" 
                         >
                              <i class="fas '.$icon.'"></i>
                         </a>
                    </div>',
                    '<div class="text-center">
                         <div class="btn-group">
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-primary title openPopup" 
                                   data-url="'. base_url("$this->url/modal/edit_gallery") .'" 
                                   data-id="'. encode64($row->id) .'-'. encode64($event_id) .'" 
                                   data-style="animated slideInDown"
                                   title="Ubah Data"
                              >
                                   <i class="fas fa-edit"></i>
                              </a> 
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-danger title delete-side" 
                                   data-message="Yakin mau dihapus ?"
                                   title="Hapus Data" 
                                   data-url="'. base_url("$this->url/delete_gallery/") .'"
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
               "recordsTotal" => intval($this->m_event->count_all_gallery()),
               "recordsFiltered" => intval($this->m_event->count_gallery()),
               "data" => $data,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($output))
          ->set_status_header(200);
     }

     public function add_gallery() {
          $event_id = decode64($this->input->post('event_id'));
          $images = $_FILES['images']['name'];
          $image_size = [300, 1920];
          $image_name = ['x300_', 'x1920_'];
          if ($images) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => "$this->dir_img/gallery/",
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $images,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('images') ) {
                    $images = $this->upload->data('file_name');
                    $this->load->library('image_lib');
                    for ($i = 0; $i < count($image_size); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/gallery/$images",
                              'new_image' => "$this->dir_img/gallery/" . $image_name[$i] . $images,
                              'maintain_ratio' => TRUE,
                              'width' => $image_size[$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
               } else {
                    $images = '';
               } 
               $data = [
                    'event_id' => $event_id,
                    'images' => $images,
                    'description' => htmlentities($this->input->post('description')),
                    'date_added' => date('Y-m-d H:i:s'),
               ];
               $added = $this->m_master->add($this->table_gallery, $data);
               $result = [
                    'response' => 200,
                    'status' => 'SUKSES',
                    'message' => 'Gallery Berhasil Ditambahkan...',
                    'affected_row' => $added,
               ];
          } else {
               $result = [
                    'response' => 302,
                    'status' => 'GAGAL',
                    'message' => 'Images Tidak Boleh Kosong...',
                    'affected_row' => 0,
               ];
          }

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function edit_gallery() {
          $id = decode64($this->input->post('id'));
          $event_id = decode64($this->input->post('event_id'));
          $images = $_FILES['images']['name'];
          $current = $this->m_event->get_gallery($id);
          $image_size = [300, 1920];
          $image_name = ['x300_', 'x1920_'];
          if ($images) {
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'upload_path' => "$this->dir_img/gallery/",
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => rand(1,99999) . "_" . $images,
               ];
               $this->load->library('upload', $config);
               if( $current->images ){
                    unlink(FCPATH . "$this->dir_img/gallery/$current->images");
                    for ($i = 0; $i < count($image_name); $i++) {
                         if (file_exists("$this->dir_img/gallery/" . $image_name[$i] . $current->images)) {
                              unlink(FCPATH . "$this->dir_img/gallery/" . $image_name[$i] . $current->images);
                         }
                    }
               }
               if ( $this->upload->do_upload('images') ) {
                    $images = $this->upload->data('file_name');
                    $this->load->library('image_lib');
                    for ($i = 0; $i < count($image_size); $i++) {
                         $gd[$i] = array(
                              'image_library' => 'gd2',
                              'source_image' => "$this->dir_img/gallery/$images",
                              'new_image' => "$this->dir_img/gallery/" . $image_name[$i] . $images,
                              'maintain_ratio' => TRUE,
                              'width' => $image_size[$i],
                         );

                         $this->image_lib->clear();
                         $this->image_lib->initialize($gd[$i]);
                         $this->image_lib->resize();
                    }
                    $response = 200;
                    $status = 'SUKSES';
                    $message = "Gallery Berhasil Diubah...";
               } else {
                    $images = '';
                    $response = 500;
                    $status = 'GAGAL';
                    $message = $this->upload->display_errors();
               } 
          } else {
               $response = 200;
               $status = 'SUKSES';
               $message = 'Gallery Berhasil Diubah';
               $images = $current->images;
          } 

          $data = [
               'event_id' => $event_id,
               'images' => $images,
               'description' => htmlentities($this->input->post('description')),
          ];
          $updated = $response === 200 ? $this->m_master->update($this->table_gallery, ['id' => $id], $data) : 0;
          $result = [
               'response' => $response,
               'status' => $status,
               'message' => $message,
               'affected_row' => $updated,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function delete_gallery() {
          $id = decode64($this->input->post('id'));
          $deleted = $this->m_master->update($this->table_gallery, ['id' => $id], ['isDelete' => 1]);
          $result = [
               'response' => 200,
               'status' => 'SUKSES',
               'message' => "Gallery Berhasil Dihapus!",
               'affected_row' => $deleted,
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function active_gallery() {
          $id = decode64($this->input->post('id'));
          $isActive = $this->input->post('code') ? 0 : 1;
          $message = $this->input->post('code') ? 'Dinonaktifkan' : 'Diaktifkan';
          $updated = $this->m_master->update($this->table_gallery, ['id' => $id], ['isActive' => $isActive]);
          $result = [
               'response' => 200,
               'status' => 'SUKSES',
               'message' => "Gallery Berhasil $message",
               'affected_row' => $updated,
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function wishes($id) {
          $event_id = decode64($id);
          $result = $this->m_event->comment(['event_id' => $event_id]);
          $data = [];
          $nomor = $this->input->post('start');
          foreach ($result as $row) {
               $rows[] = [ 
                    '<div class="text-center">'.++$nomor.'</div>', 
                    '<div class="text-left">'.$row->name.'</div>', 
                    html_entity_decode($row->message), 
                    '<div class="text-right">'.date_indo(getDates('date', $row->date_added)).'</div>',
                    '<div class="text-center">
                         <div class="btn-group">
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-danger title delete-side" 
                                   data-message="Yakin mau dihapus ?"
                                   title="Hapus Data" 
                                   data-url="'. base_url("$this->url/delete_wishes/") .'"
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
               "recordsTotal" => intval($this->m_event->count_all_gallery()),
               "recordsFiltered" => intval($this->m_event->count_gallery()),
               "data" => $data,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($output))
          ->set_status_header(200);
     }

     public function delete_wishes() {
          $id = decode64($this->input->post('id'));
          $deleted = $this->m_master->update($this->table_comment, ['id' => $id], ['isDelete' => 1]);
          $result = [
               'response' => 200,
               'status' => 'SUKSES',
               'message' => "Wishes Berhasil Dihapus!",
               'affected_row' => $deleted,
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function update_template_wa() {
          $id = decode64($this->input->post('id'));
          $template_wa = htmlentities(str_replace('\n', '%0A', $this->input->post('template_wa')));
          $data = ['template_wa' => $template_wa];
          $affected_row = $this->m_master->update($this->table, ['id' => $id], $data);

          $result = [
               'response' => 200,
               'message' => 'Template WA Berhasil Diupdate',
               'affected_row' => $affected_row,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function send_wa() {
          $id = decode64($this->input->post('id'));
          $name = rtrim(ucwords($this->input->post('name')));
          $phone = $this->input->post('phone');
          $newPhone = newPhone($phone);
          $affected_row = 0;
          $url = "https://api.whatsapp.com";
          $link = base_url("wedding_invite/to/" . strtolower(str_replace(' ', "-", $name)));
          $default = ["{link}", "{name}"];
          $change = ["*$link*", "*$name*"];
          if ($phone != 10) {
               if (!$newPhone) {
                    $response = 404;
                    $message = 'Gagal Mengirim WA Nomor Tidak Valid';
                    $affected_row = $affected_row;
                    $lastUrl = null;
               } else {
                    $event = $this->m_event->get(['event.id' => $id]);
                    $text = remakeTemplate($default, $change, $event->template_wa);
                    //check undangan
                    $invite = $this->m_event->get_undangan(['event_id' => $id, 'phone' => $newPhone]);
                    if (!$invite) {
                         $affected_row = $this->m_master->add($this->table_undangan_terkirim, [
                              'event_id' => $id,
                              'phone' => $newPhone,
                              'name' => $name,
                              'date_added' => hari_lengkap(),
                              'sent' => 1
                         ]);
                    } else {
                         $send = $invite->sent;
                         $affected_row = $this->m_master->update($this->table_undangan_terkirim, ['id' => $invite->id], [
                              'name' => $name,
                              'sent' => ($send + 1)
                         ]);
                    } 
                    $response = 200;
                    $message = "Undangan WA Berhasil Dikirim ke $name";
                    $lastUrl = "$url/send?phone=$newPhone&text=$text";
               }
          } else {
               $event = $this->m_event->get(['event.id' => $id]);
               $text = remakeTemplate($default, $change, $event->template_wa);
               //check undangan grup
               $invite = $this->m_event->get_undangan(['event_id' => $id, 'name' => $name]);
               if (!$invite) {
                    $affected_row = $this->m_master->add($this->table_undangan_terkirim, [
                         'event_id' => $id,
                         'phone' => $phone,
                         'name' => $name,
                         'date_added' => hari_lengkap(),
                         'sent' => 1
                    ]);
               } else {
                    $send = $invite->sent;
                    $affected_row = $this->m_master->update($this->table_undangan_terkirim, ['id' => $invite->id], [
                         'name' => $name,
                         'sent' => ($send + 1)
                    ]);
               } 
               $response = 200;
               $message = "Undangan WA Berhasil Dikirim ke $name";
               $lastUrl = "$url/send?text=$text";
          }

          $result = [
               'response' => $response,
               'message' => $message,
               'affected_row' => $affected_row,
               'url' => $lastUrl
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }
}
