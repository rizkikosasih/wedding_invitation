<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class halaman_statis extends CI_Controller {
     private $table = "halaman_statis";
     private $dir_img = "assets/backend/dist/img/halaman/";
     private $url;

     public function __construct() {
          parent::__construct();
          $this->load->model([
               'm_halaman_statis',
               'm_master',
          ]);
          $this->url = 'admin/' . $this->uri->segment(2);
          cek_login();
     }

     public function index() {
          $data = [
               "user" => users(),
               "content" => "$this->url/index",
               "judul" => "Halaman Statis",
               "curMenu" => "Website",
               "dir_img" => $this->dir_img,
               "url" => $this->url,
               "thead" => [
                    "No",
                    "Section",
                    "Judul",
                    "Isi",
                    "Jenis",
                    "Aktif",
                    "Aksi"
               ],
               "jenis" => [
                    "f",
                    "b"
               ],
               "tipe" => [
                    "Y",
                    "N"
               ],
          ];

          $this->load->view('templates/admin/main-app', $data);
     }

     public function modal( $action, $id=null) {
          $data = [
               "dir_img" => $this->dir_img, 
               "jenis" => [ 
                    "f", 
                    "b" 
               ], 
               "tipe" => [
                    0, 
                    1
               ], 
               "this_data" => $this->m_halaman_statis->get([
                    "id" => $id, 
               ])->row(), 
               "url" => $this->url,
               "action" => $action, 
          ];
          
          $this->load->view("$this->url/modals", $data);
          // $this->load->view("templates/admin/script_js");
     } 

     public function allData() {
          cek_login();
          $result = $this->m_halaman_statis->allData();
          $nomor = $this->input->post('start');
          $data = [];
          foreach ($result as $key => $row) {
               $tBtn = $row->isActive == 1 ? "Aktif" : "Non-Aktif";
               $icon = $row->isActive == 1 ? "fas fa-check text-success" : "fas fa-times text-danger";
               $msg = $row->isActive == 1 ? "Yakin mau dinonaktifkan?" : "Yakin mau diaktifkan?";
               $nama_jenis = $row->jenis == "b" ? "Backend" : "Frontend";
               if( $row->isImage == 1 ){
                    $isi = '
                    <a 
                         href="'.base_url($this->dir_img . "$row->jenis/$row->isi").'" 
                         class="lightbox title" 
                         data-title="'.$row->judul.'" 
                         title="Isi Halaman"
                    >
                         <img 
                              src="'.base_url($this->dir_img . "$row->jenis/$row->isi").'" 
                              alt="'.$row->judul.'" 
                              class="img-rounded produk-thumbnail"
                         >
                    </a>
                    ';
                    $class_isi = "text-center";
               } else {
                    $isi = deskripsi(html_entity_decode($row->isi),100);
                    $class_isi = "text-left";
               }

               $rows[] = array(
                    "<div class='text-center'>".++$nomor."</div>",
                    "<div class='text-left'>$row->section</div>",
                    "<div class='text-left'>$row->judul</div>",
                    "<div class='$class_isi'>$isi</div>", 
                    "<div class='text-center'>$nama_jenis</div>", 
                    '<div class="text-center">
                         <a 
                              href="javascript:void(0)" 
                              class="title status-side" 
                              title='.$tBtn.' 
                              data-message="'.$msg.'" 
                              data-url="'.base_url("$this->url/aktifasi/").'" 
                              data-id="'.encode64($row->id).'" 
                              data-code="'.$row->isActive.'" 
                         >
                              <i class="'.$icon.'"></i>
                         </a>
                    </div>
                    ', 
                    '
                    <div class="text-center">
                         <div class="btn-group">
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-primary title openPopup" 
                                   data-url="'. base_url("$this->url/modal/edit") .'" 
                                   data-id="'. $row->id .'" 
                                   data-style="modal-lg animated slideInDown"
                                   title="Ubah Data"
                              >
                                   <i class="fas fa-edit"></i>
                              </a>
                              <a 
                                   href="javascript:void(0)" 
                                   class="btn btn-xs btn-danger title delete-side" 
                                   data-message="Yakin mau dihapus ?"
                                   title="Hapus Data" 
                                   data-url="'. base_url("$this->url/hapus/") .'"
                                   data-id="'. encode64($row->id) .'"
                              >
                                   <i class="fas fa-trash"></i>
                              </a>
                         </div>
                    </div>
                    ',
               );
               $data = $rows;
          }

          $output = [
               "draw" => intval($this->input->post('draw')),
               "recordsTotal" => intval($this->m_halaman_statis->countAllData()),
               "recordsFiltered" => intval($this->m_halaman_statis->countFilterData()),
               "data" => $data,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($output))
          ->set_status_header(200);
     }

     public function add() {
          $user = users();
          $upload_image = $_FILES['foto']['name'];
          $path = $this->dir_img . $this->input->post('jenis') . "/";
          if ( $upload_image ) {
               $filename = rand(1,99999) . "_" . $upload_image;
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg',
                    'max_size' => '2048',
                    'upload_path' => $path,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => $filename,
               ];
               $this->load->library('upload', $config);
               if ( $this->upload->do_upload('foto') ) {
                    $isi = $this->upload->data('file_name');
                    $error = '';
               } else {
                    $isi = '';
                    $error = $this->upload->display_errors();
               }
          } else {
               $isi = htmlChange(ucwords($this->input->post('isi')));
               $error = "";
          }

          $data = [
               'section' => strtolower($this->input->post('section')),
               'judul' => ucwords($this->input->post('judul')),
               'jenis' => $this->input->post('jenis'),
               'isi' => $isi,
               'isImage' => $this->input->post('isImage'),
               'date_added' => hari_lengkap(),
          ];

          if (!$error) {
               $this->m_master->add($this->table, $data);
               $result = [
                    "response" => 200,
                    "status" => "SUKSES",
                    "message" => "Berhasil menambahkan data !",
               ];
          } else {
               $result = [
                    "response" => 500,
                    "status" => "SUKSES",
                    "message" => $error,
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
          $message = $code == 1 ? "Halaman Statis Berhasil Dinonaktifkan!" : "Halaman Statis Berhasil Diaktifkan!";
          $data = [
               "isActive" => $nCode,
          ];
          $this->m_master->update($this->table, [
               'id' => $id
          ], $data);

          $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => $message,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_status_header(200)
          ->set_output(json_encode($result));
     }

     public function edit() {
          $id = $this->input->post('id');
          $g = $this->m_halaman_statis->get([
               'id' => $id
          ])->row();
          $user = users();
          $upload_image = $_FILES['foto']['name'];
          $path = $this->dir_img . $this->input->post('jenis') . "/";
          if ($upload_image) {
               $filename = rand(1,99999) . "_" . $upload_image;
               $config = [
                    'allowed_types' => 'gif|jpg|png|jpeg|ico',
                    'max_size' => '1048',
                    'upload_path' => $path,
                    'remove_spaces' => true,
                    'file_ext_tolower' => true,
                    'file_name' => $filename,
               ];
               $this->load->library('upload', $config);
               if ($this->upload->do_upload('foto')) {
                    if( $g->isImage == 1 ){
                         unlink(FCPATH . $this->dir_img . "$g->jenis/$g->isi");
                    }
                    $isi = $this->upload->data('file_name');
                    $error = "";
               } else {
                    $isi = "";
                    $error = $this->upload->display_errors();
               }
          } else {
               if( $g->isImage == 1 ){
                    unlink(FCPATH . $this->dir_img . "$g->jenis/$g->isi");
               }
               $isi = !$this->input->post('isi') ? $g->isi : htmlChange($this->input->post('isi'));
               $error = "";
          }

          $data = [
               'section' => strtolower($this->input->post('section')),
               'judul' => ucwords($this->input->post('judul')),
               'isi' => $isi,
               "isImage" => $this->input->post('isImage'),
               "jenis" => $this->input->post('jenis'),
          ];

          if (!$error) {
               $this->m_master->update($this->table,[
                    'id' => $id
               ], $data);

               $result = [
                    "response" => 200,
                    "status" => "SUKSES",
                    "message" => "Halaman Statis berhasil diperbarui !",
               ];
          }else{
               $result = [
                    "response" => 500,
                    "status" => "GAGAL",
                    "message" => $error,
               ];
          }

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function hapus() {
          $id = decode64($this->input->post('id'));
          if ( $this->m_master->delete($this->table, [ "id" => $id ]) > 0 ) {
               $result = [
                    "response" => 200,
                    "status" => "SUKSES",
                    "message" => "Berhasil menghapus data !",
               ];
          } else {
               $result = [
                    "response" => 500,
                    "status" => "GAGAL",
                    "message" => "Gagal menghapus data !",
               ];
          }

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }
}