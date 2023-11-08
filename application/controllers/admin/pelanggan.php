<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pelanggan Extends CI_Controller {
	private $table = "pelanggan";
	private $url;

	public function __construct() {
		parent::__construct();
		$this->load->model([
			'm_master',
			'm_pelanggan',
		]);
		$this->url = 'admin/' . $this->uri->segment(2);
		cek_login();
	}

	public function index() {
		$data = [
			"user" => users(),
			"content" => "$this->url/index",
			"judul" => "Pelanggan",
			"curMenu" => "Administrator",
			"url" => $this->url,
			"thead" => [
				"No",
				"Nama Depan",
				"Nama Belakang",
				"Alamat",
				"No Handphone",
				"Active",
				"Aksi",
			],
		];
		$this->load->view("templates/admin/main-app", $data);
	}

	public function allData() {
		$result = $this->m_pelanggan->allData();
		$data = [];
		$nomor = $this->input->post('start');

		foreach ($result as $row) {
			$titleA = $row->isActive == 1 ? "dinonaktifkan ?" : "diaktifkan ?";
			$iconA = $row->isActive == 1 ? "fas fa-check text-success" : "fas fa-times text-danger";

			$rows[] = [
				'<div class="text-center">'.++$nomor.'</div>',
				$row->nama_depan,
				$row->nama_belakang,
				deskripsi($row->alamat),
				'<div class="text-right">'. no_hp($row->no_hp) .'</div>',
				'
				<div class="text-center">
					<a
						href="javascript:void(0)"
						class="title status-side"
						data-message="Yakin mau '.$titleA.'"
						title="Activate"
						data-url="'. base_url("$this->url/aktifasi/") .'"
						data-id="'.encode64($row->id).'"
						data-code="'.$row->isActive.'"
					>
						<i class="'.$iconA.'"></i>
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
			"recordsTotal" => intval($this->m_pelanggan->countAllData()),
			"recordsFiltered" => intval($this->m_pelanggan->countFilterData()),
			"data" => $data,
		];

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($output))
		->set_status_header(200);
	}

	public function modal($action, $id=null) {
		$data = [
			"this_data" => $this->m_pelanggan->byId($id),
			"url" => $this->url,
			"action" => $action,
		];

		$this->load->view("$this->url/modals", $data);
		// $this->load->view("templates/admin/script_js");
	}

	public function add() {
		$data = [
			"nama_depan" => ucwords($this->input->post('nama_depan')),
			"nama_belakang" => ucwords($this->input->post('nama_belakang')),
			"alamat" => htmlChange($this->input->post('alamat')),
			"no_hp" => str_replace('-','',$this->input->post('no_hp')),
			"createDate" => dateTimeNow(),
		];

		if ($this->m_master->add($this->table, $data) > 0) {
			$result = [
				"response" => 200,
				"status" => "SUKSES",
				"message" => "Berhasil menambahkan data !"
			];
		} else {
			$result = [
				"response" => 500,
				"status" => "GAGAL",
				"message" => "Gagal menambahkan data !"
			];
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($result))
		->set_status_header(200);

	}

	public function edit() {
		$where = [
			"id" => $this->input->post('id'),
		];
		$data = [
			"nama_depan" => ucwords($this->input->post('nama_depan')),
			"nama_belakang" => ucwords($this->input->post('nama_belakang')),
			"alamat" => htmlChange($this->input->post('alamat')),
			"no_hp" => str_replace('-','',$this->input->post('no_hp'))
		];

		if ($this->m_master->update($this->table, $where, $data) > 0) {
			$result = [
				"response" => 200,
				"status" => "SUKSES",
				"message" => "Berhasil merubah data !"
			];
		} else {
			$result = [
				"response" => 500,
				"status" => "GAGAL",
				"message" => "Gagal merubah data !"
			];
		}

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($result))
		->set_status_header(200);
	}

	public function hapus() {
		$where = [
			'id' => decode64($this->input->post('id')),
		];
		$data = [
			"isDelete" => 1
		];
		if ($this->m_master->update($this->table,$where,$data) > 0) {
			$result = [
				"response" => 200,
				"status" => "SUKSES",
				"message" => "Data berhasil dihapus !"
			];
		} else {
			$result = [
				"response" => 500,
				"status" => "GAGAL",
				"message" => "Data gagal dihapus !"
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
		$nCode = $code == 0 ? 1 : 0;
		$message = $nCode == 0 ? "Pelanggan berhasil dinonaktifkan !" : "Pelanggan berhasil diaktifkan !";
		$where = [
			'id' => $id
		];
		$data = [
			'isActive' => $nCode
		];
		$this->m_master->update($this->table, $where,$data);

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
}