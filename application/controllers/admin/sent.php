<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sent extends CI_Controller {
	private $dir_img = 'assets/public/images';
	private $table = 'undangan_terkirim';

	public function __construct() {
		parent::__construct();
		$this->load->model(['m_user', 'm_menu', 'm_master', 'm_sent']);
		$this->url = 'admin/' . $this->uri->segment(2);
		cek_login();
	}

	public function index() {
		$data = [
			'user' => users(),
			"content" => "$this->url/index",
			'judul' => 'Undangan Terkirim',
			'curMenu' => 'Administrator',
			"url" => $this->url,
			'thead' => ['no', 'phone', 'name', 'sent', 'date added', 'action'],
		];
		$this->load->view("templates/admin/main-app", $data);
	}

	public function allData() {
		$result = $this->m_sent->sent(['event_id' => 1]);
		$data = [];
		$nomor = $this->input->post('start');
		foreach ($result as $row) {
			$initPhone = substr($row->phone, 0, 2);
			$phone = $initPhone != 62 ? $row->phone : substr($row->phone, 2);
			$initPhone = $initPhone != 62 ? 62 : $initPhone;
			$phone = '+' . $initPhone . '-' . no_hp($phone);
			$rows[] = [
				'<div class="text-center">'.++$nomor.'</div>',
				'<div class="text-right">'.$phone.'</div>',
				'<div class="text-left">'.$row->name.'</div>',
				'<div class="text-center title" title="Undangan Terkirim"><span class="badge bg-success p-2">'.$row->sent.'</span></div>',
				'<div class="text-center text-capitalize">'.date_indo(getDates('date', $row->date_added)).'</div>',
				'<div class="text-center">
					<div class="btn-group">
						<a
							href="javascript:void(0)"
							class="btn btn-xs btn-warning title send-wa"
							data-phone="'.$row->phone.'"
							data-name="'.$row->name.'"
							data-id="'.encode64($row->event_id).'"
							data-url="'. base_url("admin/event/send_wa") .'"
							title="Kirim Ulang Undangan"
						>
							<i class="fa-brands fa-whatsapp"></i>
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
			"recordsTotal" => intval($this->m_sent->count_all_sent()),
			"recordsFiltered" => intval($this->m_sent->count_sent()),
			"data" => $data,
		];

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($output))
		->set_status_header(200);
	}

	public function delete() {
		$id = decode64($this->input->post('id'));
		$deleted = $this->m_master->delete($this->table, ['id' => $id]);
		$result = [
			'response' => 200,
			'status' => 'SUKSES',
			'message' => "Undangan WA Berhasil Dihapus!",
			'affected_row' => $deleted,
		];
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($result))
		->set_status_header(200);
	}
}