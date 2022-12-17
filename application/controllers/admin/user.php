<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {
    private $url;
    private $table = "user";
    private $dir_img = "assets/backend/dist/img/profile/";

    public function __construct() {
        parent::__construct();
        $this->load->model([
            'm_user',
            'm_grup',
            'm_master',
        ]);
        $this->url = 'admin/' . $this->uri->segment(2);
    }

    public function index() {
        cek_login();
        $id = $this->session->userdata('id');
        $data = [
            'user' => users(),
            "content" => "$this->url/index",
            'judul' => "Data User",
            'curMenu' => "Website",
            'dir_img' => $this->dir_img,
            "url" => $this->url,
            'thead' => array(
                "No",
                "Username",
                "Nama Lengkap",
                "Alamat",
                "No Handphone",
                "Aktif",
                "Aksi"
            ),
        ];

        $this->load->view('templates/admin/main-app', $data);
    }

    public function profile() {
        $data = [
            'user' => users(),
            "content" => "$this->url/profile",
            'judul' => 'Data User',
            'curMenu' => 'Website',
            'curPage' => 'Profile Saya',
            'dir_img' => $this->dir_img,
            "url" => $this->url,
        ];

        $this->load->view('templates/admin/main-app', $data);
    }

    public function modal($action, $id=null) {
        $data = [
            "grup" => $this->m_grup->get([
                "id !=" => 4
            ])->result(), 
            "this_data" => $this->m_user->get([
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
        $result = $this->m_user->allData();
        $data = [];
        $nomor = $this->input->post('start');

        foreach ($result as $row) {
            $icon = $row->isActive == 1 ? "fa-check text-success" : "fa-times text-danger";
            $tBtn = $row->isActive == 1 ? "Aktif" : "Non-Aktif";
            $msg = $row->isActive == 1 ? "Yakin mau dinonaktifkan?" : "Yakin mau diaktifkan?";

            $rows[] = [ 
                '<div class="text-center">'.++$nomor.'</div>', 
                '
                <div class="text-center">
                    <a 
                        href="javascript:void(0)" 
                        class="title openPopup" 
                        data-url="'.base_url('user/modal/detail_user').'" 
                        data-id="'.$row->id.'" 
                        data-style="animated slideInDown"
                        title="Detail User"
                    >
                        '.$row->username.'
                    </a>
                </div>
                ', 
                "<div class='text-left'>$row->nama</div>", 
                "<div class='text-left'>$row->alamat</div>", 
                '<div class="text-right">'. no_hp($row->no_hp) .'</div>',
                '
                <div class="text-center">
                    <a 
                        href="javascript:void(0)" 
                        class="title status-side" 
                        title="'.$tBtn.'"
                        data-message="'.$msg.'"
                        data-url="'.base_url("$this->url/aktifasi/").'"
                        data-id="'.encode64($row->id).'"
                        data-code="'.$row->isActive.'"
                    >
                        <i class="fas '.$icon.'"></i>
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
                            <!--
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
                            -->
                        </div>
                </div>
                '
            ];

            $data = $rows;
        }

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($this->m_user->countAllData()),
            "recordsFiltered" => intval($this->m_user->countFilterData()),
            "data" => $data,
        ];

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($output))
        ->set_status_header(200);
    }

    public function add() {
        cek_login();
        $this->form_validation->set_rules('username', 'username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('grup_id', 'grup_id', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|is_unique[user.email]');

        if ($this->form_validation->run() == FALSE) {
            $result = [
                "response" => 500,
                "status" => "GAGAL",
                "message" => "Periksa kembali form tambah user !",
            ];
        } else {
            $alamat = htmlChange($this->input->post('alamat', true));

            $data = [
                "username" => $this->input->post('username', true),
                "nama" => ucwords($this->input->post('nama', true)),
                "password" => md5($this->input->post('username', true) . 123),
                "grup_id" => $this->input->post('grup_id', true),
                "tempat_lahir" => ucwords($this->input->post('tempat_lahir', true)),
                "tanggal_lahir" => ucwords($this->input->post('tanggal_lahir', true)),
                "email" => $this->input->post('email', true),
                "jenis_kelamin" => $this->input->post('jenis_kelamin', true),
                "no_hp" => str_replace( '-', '',$this->input->post('no_hp', true)),
                "alamat" => $alamat,
                "date_created" => date('Y-m-d')
            ];

            $tambah = $this->m_master->add($this->table,$data);
            
            $result = [
                "response" => 200,
                "status" => "SUKSES",
                "message" => "User berhasil diperbarui !",
            ];
        }

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result))
        ->set_status_header(200);
    }

    public function edit() {
        cek_login();
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('grup_id', 'grup_id', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal_lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required');

        if ($this->form_validation->run() == FALSE) {
            $result = [
                "response" => 500,
                "status" => "GAGAL",
                "message" => "Periksa kembali form ubah user !",
            ];
        } else {
            $username = $this->input->post('username');
            $alamat = htmlChange($this->input->post('alamat'));

            $data = [
                "nama" => ucwords($this->input->post('nama', true)),
                "grup_id" => $this->input->post('grup_id', true),
                "tempat_lahir" => ucwords($this->input->post('tempat_lahir', true)),
                "tanggal_lahir" => ucwords($this->input->post('tanggal_lahir', true)),
                "email" => $this->input->post('email', true),
                "jenis_kelamin" => $this->input->post('jenis_kelamin', true),
                "no_hp" => str_replace( '-', '',$this->input->post('no_hp', true)),
                "alamat" => $alamat,
                // "password" => $password,
            ];

            $this->m_master->update($this->table, [ 
                'username' => $username
            ], $data);

            $result = [
               "response" => 200,
               "status" => "SUKSES",
               "message" => "User berhasil diperbarui !",
           ];
        }

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result))
        ->set_status_header(200);
    }

    public function hapus() {
        cek_login();
        $where = [
            'id' => decode64($this->input->post('id'))
        ];
        $u = $this->m_user->get($where)->row();

        if( !empty($u->foto) ){
            unlink(FCPATH . $this->dir_img . $u->foto);
        }

        if ($this->m_master->delete($this->table, $where) > 0) {
            $result = [
                "response" => 200,
                "status" => "SUKSES",
                "message" => "User berhasil dihapus !",
            ];
        } else {
            $result = [
                "response" => 500,
                "status" => "GAGAl",
                "message" => "Tidak dapat menghapus user !",
            ];
        }

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result))
        ->set_status_header(200);
    }

    public function aktifasi() {
        cek_login();
        $id = decode64($this->input->post('id'));
        $code = $this->input->post('code');
        $nCode = $code == 1 ? 0 : 1;
        $message = $code == 1 ? "User berhasil dinonaktifkan!" : "User berhasil diaktifkan!";
        $data = [
            'isActive' => $nCode
        ];
        $this->m_master->update( $this->table, [
            'id' => $id
        ], $data);

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

    public function ubah_profile() {
        $id = $this->input->post('id',true);
        $old = $this->m_user->get([
            'id' => $id
        ])->row();

        $error = '';
        $upload_image = $_FILES['foto']['name'];
        if ($upload_image) { // cek jika ada gambar yang akan diupload
            if( !file_exists( $this->dir_img) ){
                mkdir($this->dir_img, 0777, true);
            }
            $filename = rand(1,99999) . "_" . fileName($upload_image);
            $config = [
                'allowed_types' => 'gif|jpg|png|jpeg',
                'max_size' => '2048',
                'upload_path' => $this->dir_img,
                'remove_spaces' => true,
                'file_ext_tolower' => true,
                'file_name' => $filename,
            ];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                if ($old->foto) {
                    unlink(FCPATH . $this->dir_img . $old->foto);
                }
                $new_foto = $this->upload->data('file_name');
            } else {
                $error = $this->upload->display_errors();
            }
        } else {
            $new_foto = $old->foto;
        }

        $alamat = htmlChange($this->input->post('alamat',true));
        $data = [
            'nama' => ucwords($this->input->post('nama',true)),
            'email' => $this->input->post('email',true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin',true),
            'tempat_lahir' => ucwords($this->input->post('tempat_lahir',true)),
            'tanggal_lahir' => $this->input->post('tanggal_lahir',true),
            'alamat' => $alamat,
            'no_hp' => str_replace('-', '', $this->input->post('no_hp',true)),
            'foto' => $new_foto
        ];

        if (!$error) {
            $this->m_master->update($this->table, ['id' => $id], $data);
            $message = "sukses/Profile/Diubah!";
        } else {
            $error = str_replace('/','-',$error);
            $message = "gagal/Profile/$error";
        }

        $this->session->set_flashdata('message', $message);
        redirect('admin/user/profile');
    }

    public function ubah_password() {
        $id = $this->session->userdata('id');
        $data = [
            'user' => users(),
            "content" => "$this->url/ubah_password",
            'judul' => 'Data User',
            'curMenu' => 'Website',
            'curPage' => 'Ubah Password',
            "url" => $this->url,
        ];

        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
        $this->form_validation->set_rules('password', 'Password Baru', 'required|matches[re_password]', [ 
            'matches' => '%s Harus Sama Dengan Konfirmasi Password Baru.' 
        ]);
        $this->form_validation->set_rules('re_password', 'Konfirmasi Password Baru', 'required|matches[password]', [ 
            'matches' => '%s Harus Sama Dengan Password Baru.' 
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin/main-app',$data);
        } else {
            $oldPass = md5($this->input->post('password_lama', true));
            $newPass = md5($this->input->post('password', true));
            if($oldPass != $data['user']->password) {
                $this->session->set_flashdata('message', 'gagal/Password/Diubah Karena Password Lama Tidak Sama!');
            } else {
                if( $newPass == $oldPass ) {
                    $this->session->set_flashdata('message', 'gagal/Password/Diubah Password Baru Tidak Boleh Sama Dengan Password Lama!');
                } else {
                    $data = [
                        'password' => $newPass
                    ];
                    $this->m_master->update($this->table, [
                        'id' => $id
                    ], $data);
                    $this->session->set_flashdata('message', 'sukses/Password/Diubah!');
                }
            }

            redirect('admin/user/ubah_password');
        }
    }

    public function update_tema() {
        $tema = $this->input->post('tema') == 'dark-mode' ? 'light-mode' : 'dark-mode';
        $where = array(
            'id' => $this->session->userdata('id'),
        );
        $data = array(
            'tema' => $tema,
        );
        $this->m_master->update($this->table,$where,$data);
        $sidebar = tema('sidebar');

        $result = array(
            'response' => 200, 
            'message' => 'Tema Berhasil Diubah !', 
            'new_theme' => $tema, 
            'sidebar' => $sidebar, 
        );

        $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($result, JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES))
        ->set_status_header(200);
    }
}
