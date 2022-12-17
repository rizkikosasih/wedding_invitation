<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class grup extends CI_Controller {
     private $table = "grup";
     private $url;

     public function __construct() {
          parent::__construct();
          $this->load->model([
               'm_grup',
               'm_user',
               'm_menu',
               'm_master',
          ]);
          $this->url = 'admin/' . $this->uri->segment(2);
          cek_login();
     }

     public function index() {
          $data = [
               'user' => users(),
               "content" => "$this->url/index",
               'judul' => 'Grup',
               'curMenu' => 'Website',
               "url" => $this->url, 
               'thead' => array(
                    'No', 
                    'Nama Grup', 
                    'Deskripsi', 
                    'Aksi' 
               ),
          ];
          $this->load->view('templates/admin/main-app', $data);
     } 

     public function modal($action,$id=null) {
          $data = [
               "this_data" => $this->m_grup->get([
                    "id" => $id
               ])->row(), 
               "url" => $this->url, 
               "action" => $action, 
          ];

          $this->load->view("$this->url/modals", $data);
          // $this->load->view("templates/admin/script_js");
     } 

     public function allData() {
          $result = $this->m_grup->allData();
          $data = [];
          $nomor = $this->input->post('start');
          foreach ($result as $row) {
               $rows[] = [ 
                    '<div class="text-center">'.++$nomor.'</div>', 
                    $row->nama_grup, 
                    $row->deskripsi, 
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
                                   data-id="'.encode64($row->id).'"
                              >
                                   <i class="fas fa-trash"></i>
                              </a> 
                         </div>
                    </div>
                    '
               ];

               $data = $rows;
          }

          $output = [
               "draw" => intval($this->input->post('draw')),
               "recordsTotal" => intval($this->m_grup->countAllData()),
               "recordsFiltered" => intval($this->m_grup->countFilterData()),
               "data" => $data,
          ];

          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($output))
          ->set_status_header(200);
     }

     public function add() {
          $data = [
               "nama_grup" => ucwords($this->input->post('nama_grup')),
               "deskripsi" => ucwords($this->input->post('deskripsi')),
          ];
          $tambah = $this->m_master->add($this->table, $data);
          $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => "Grup baru berhasil ditambahkan !",
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function edit() {
          $data = [
               "nama_grup" => ucwords($this->input->post('nama_grup')),
               "deskripsi" => ucwords($this->input->post('deskripsi')),
          ];
          
          $tambah = $this->m_master->update($this->table, array(
               "id" => $this->input->post('id')
          ), $data);

          $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => "Grup berhasil diperbarui !",
          ];
          
          $this->output
               ->set_content_type('application/json')
               ->set_output(json_encode($result))
               ->set_status_header(200);
     }

     public function hapus() {
          $id = decode64($this->input->post('id'));
          $deleteGrup = $this->m_master->delete($this->table, array( 'id' => $id ));
          if ( $deleteGrup > 0 ) { #delete akses menu by grup
               $this->m_master->delete('akses_menu', array(
                    'grup_id' => $id
               ));
               $result = [
                    "response" => 200,
                    "status" => "SUKSES",
                    "message" => "Grup berhasil dihapus !",
               ];
          } else {
               $result = [
                    "response" => 500,
                    "status" => "GAGAL",
                    "message" => "Grup gagal dihapus !",
               ];
          }
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }
     
}
