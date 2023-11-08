<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller  {
	private $table = "user";

	public function __construct() {
		parent::__construct();
		$this->load->model(['m_user', 'm_master']);
	}

	public function blocked() {
		$this->load->view('errors/html/blocked');
	}

	public function index() {
		$this->form_validation->set_rules('username', 'Username', 'required', array('required' => '%s tidak boleh kosong.'));
		$this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s tidak boleh kosong.'));
		if ($this->form_validation->run() == false) {
			$data = [
				'judul' => 'Login Page',
				'class' => 'login-box',
				'content' => 'admin/auth/index',
			];
			$this->load->view('templates/admin/auth/main-app', $data);
		} else {
			$this->_login();
		}
	}

	private function _login() {
		$username = $this->input->post('username', true);
		$password = md5($this->input->post('password', true));
		$query = $this->m_user->get(array('username' => $username, 'password' => $password), array('email' => $username));
		$row = $query->row();

		if ( !isset($row) ) {
			$this->session->set_flashdata('message', 'gagal/Username atau Password tidak ditemukan!');
			redirect('admin/auth');
			// echo "error username/password";
		} elseif($row->aktif == 'N') {
			$this->session->set_flashdata('message', 'gagal/Login gagal akun tidak aktif!');
			redirect('admin/auth');
		} else {
			$newdata = [
				'id' => $row->id,
				'username' => $row->username,
				'password' => $row->password,
				'level' => $row->level
			];
			$this->session->set_userdata($newdata);
			redirect('admin/dashboard');
		}
	}

	public function logout() {
		$id = $this->session->userdata('id');
		$this->m_master->update($this->table, ['id' => $id], ['last_login' => dateTimeNow()]);
		$data = array('id', 'username', 'password', 'level');
		$this->session->unset_userdata($data);
		$this->session->set_flashdata('message', 'sukses/Anda Berhasil Logout!');
		redirect('admin/auth');
	}

	private function _sendEmail($token, $type, $email, $nama) {
		if ($type == 'verify') {
			$data = [
				'nama' => $nama,
				'email_penerima' => $email,
				'subjek' => 'Verifikasi Akun',
				'content' => 'Klik tautan ini untuk memverifikasi akun anda : <a href="' . base_url('admin/auth/verify/' . $token) .'" target="_blank">Activate</a>'
			];
		} else if ($type == 'forgot') {
			$data = [
				'nama' => $nama,
				'email_penerima' => $email,
				'subjek' => 'Reset Password',
				'content' => 'Klik tautan ini untuk merubah password anda : <a href="' . base_url('admin/auth/reset_password/' . $token) . '" target="_blank">Reset Password</a>'
			];
		}
		return $this->mailer->send(json_encode($data, JSON_PRETTY_PRINT));
	}

	public function register() {
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]', ['required' => '%s tidak boleh kosong.', 'is_unique' => '%s telah digunakan' ]);
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]', [ 'required' => '%s tidak boleh kosong.', 'is_unique' => '%s telah digunakan' ]);
		if ($this->form_validation->run() == false) {
			$data = [
				'judul' => 'Register Page',
				'curMenu' => 'Registrasi',
				'class' => 'regis-box',
				'content' => 'admin/auth/register',
			];
			$this->load->view( 'templates/admin/auth/main-app', $data );
		} else {
			$email = $this->input->post('email', true);
			$nama = ucwords($this->input->post('nama_lengkap'));
			$token = createToken();
			$data = [
				'username' => $this->input->post('username', true), 
				'nama_lengkap' => $nama, 
				'password' => md5($this->input->post('username',true).'123'), 
				'grup_id' => 4, 
				'jenis_kelamin' => $this->input->post('jenis_kelamin'), 
				'email' => $email, 
				'aktif' => 'N', 
				'token' => $token, 
				'token_id' => 1, 
				'date_created' => dateNow(), 
			];

			$content = array(
				'nama' => $nama, 
				'email_penerima' => $email, 
				'subjek' => 'Verifikasi Akun', 
				'content' => 'Klik tautan ini untuk memverifikasi akun anda : <a href="' . base_url('admin/auth/verifikasi/' . $token) .'" target="_blank">Activate</a>'
			);

			#kirim email activation
			$siMail = json_encode( $content, JSON_UNESCAPED_SLASHES, JSON_PRETTY_PRINT );
			$sendMail = $this->mailer->send($siMail);
			$result = json_decode($sendMail);
			if ($result->status == 'sukses') {
				$this->session->set_flashdata('message', 'sukses/Berhasil membuat akun, periksa email anda untuk verifikasi akun!');
				$this->m_master->add($this->table,$data);
				redirect('admin/auth');
			} else {
				$this->session->set_flashdata( 'message', 'gagal/Gagal membuat akun!<br>' . $result->message );
				redirect('admin/auth/register');
			}
		}
	} 

	public function verifikasi($token = 'kosong') {
		$user = $this->m_user->get(array(
			'token' => $token,
			'token_id' => 1,
		))->row();

		if ( isset($user) ) {
			$result = 200;
			$this->m_master->update( 
				$this->table, 
				array( 
					'id' => $user->id 
				), 
				array(
					'aktif' => 'Y',
					'token' => ''
				)
			);
		} else {
			$result = 501;
		}

		$data = [
			'judul' => 'Verifikasi Akun',
			'curMenu' => 'Verifikasi Akun',
			'class' => 'verify-box',
			'result' => $result,
			'content' => 'admin/auth/verifikasi'
		];
		$this->load->view( 'templates/admin/auth/main-app', $data );
	}

	public function lupa_password() {
		$this->form_validation->set_rules('email', 'Email', 'required', [
			'required' => '%s tidak boleh kosong.'
		]);
		
		if( $this->form_validation->run() == false ) {
			$data = [
				'judul' => 'Lupa Password',
				'curMenu' => 'Lupa Password',
				'class' => 'login-box',
				'content' => 'admin/auth/lupa_password',
			];
			$this->load->view('templates/admin/auth/main-app', $data);
		} else {
			$email = $this->input->post('email',true);
			$d = $this->m_user->get([
				'email' => $email
			])->row();
			$token = createToken();
			if (isset($d)){
				$this->m_master->update(
					$this->table, 
					array( 
						'email' => $email 
					), 
					array(
						'token' => $token,
						'token_id' => 2,
					)
				);

				$content = array(
					'nama' => '',
					'email_penerima' => $email,
					'subjek' => 'Pemulihan Akun',
					'content' => 'Klik tautan ini untuk merubah password anda : <a href="' . base_url('admin/auth/reset_password/' . $token) .'" class="btn btn-sm btn-primary" target="_blank">Reset Password</a>'
				);

				$siMail = json_encode( $content, JSON_UNESCAPED_SLASHES, JSON_PRETTY_PRINT );
				$sendMail = $this->mailer->send($siMail);
				$result = json_decode($sendMail);
				if ( $result->status == 'sukses' ) {
					$this->session->set_flashdata('message', 'sukses/Tautan pemulihan telah dikirimkan ke ' . $email .  ',<br> silahkan periksa email anda !');
					redirect('admin/auth');
				} else {
					$this->session->set_flashdata( 'message', 'gagal/Gagal mengirimkan tautan pemulihan!<br>' . $result->message 
					);
					redirect('admin/auth/lupa_password');
				}
			} else {
				$this->session->set_flashdata( 'message', 'gagal/Email yang anda masukkan tidak ditemukan' );
				redirect('admin/auth/lupa_password');
			}
		}
	}

	public function reset_password($token = 'kosong') {
		$user = $this->m_user->get([
			'token' => $token,
			'token_id' => 2,
		])->row();
		
		if( isset($user) ) {
			$result = 200;
			$id = $user->id;
		} else {
			$result = 302;
			$id = "";
		} #cek token user

		$data = [ 
			'judul' => 'Reset Password',
			'curMenu' => 'Reset Password',
			'class' => 'login-box',
			'result' => $result,
			'id' => $id,
			'content' => 'admin/auth/reset_password',
		];

		$this->form_validation->set_rules('password', 'Password Baru', 'required|matches[re_password]', [ 
			'required' => '%s tidak boleh kosong.',
			'matches' => '%s Harus sama dengan Repeat Password.'
		]);
		$this->form_validation->set_rules('re_password', 'Repeat Password', 'required|matches[password]', [
			'required' => '%s tidak boleh kosong.',
			'matches' => '%s harus sama dengan Password.'
		]);

		if( $this->form_validation->run() === false ) {
			$this->load->view('templates/admin/auth/main-app', $data);
		} else {
			$idUser = $this->input->post('id', true);
			$password = $this->input->post('password', true);
			$re_password = $this->input->post('re_password', true);
			$nPwd = md5($password);
			if ( $password != $re_password ) {
				$this->session->set_flashdata( 'message', 'gagal/Password baru dan Repeat Password tidak sama' );
				redirect('admin/auth/reset_password');
			} else {
				$newdata = [
					'token' => '',
					'password' => $nPwd
				];
				$this->m_master->update($this->table, array(
					'id' => $user->id
				), $newdata);
				$this->session->set_flashdata('message', 'sukses/Password berhasil diubah');
				redirect('admin/auth');
			} #password and re password
		} //validation form
	} 
}
