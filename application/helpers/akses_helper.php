<?php
if (!function_exists("cek_login")) {
	function cek_login() {
		$ci =& get_instance();
		$ci->load->model("m_menu");
		if (!$ci->session->id) {
			$ci->session->set_flashdata("message", "gagal/Silahkan Login Terlebih Dahulu!");
			redirect("admin/auth");
		} else {
			$user = users();
			$grup_id = $user->grup_id;
			$curMenu = $ci->uri->segment(2);
			#cari id pada tabel menu
			$whereMenu = [
				"url" => $curMenu,
				"isActive" => 1
			];
			$menu = $ci->m_menu->get($whereMenu)->row();
			$menuId = isset($menu) ? $menu->id : 0;
			$get_akses = $ci->m_menu->get_akses(array(
				"menu_id" => $menuId,
				"grup_id" => $grup_id
			));

			if ($get_akses->num_rows() < 1) {
				redirect("auth/blocked");
			}
		}
	}
}

if (!function_exists("cek_customer")) {
	function cek_customer() {
		$ci =& get_instance();
		if (empty($ci->session->id)) {
			$ci->session->set_flashdata("message", "gagal/Silahkan Login Terlebih Dahulu!");
			redirect("author");
		}

		if (users()->level != "customer") {
			redirect("dashboard");
		}
	}
}

if (!function_exists("cek_grup")) {
	function cek_grup($id) {
		$ci = get_instance();
		$ci->load->model(["m_grup"]);
		$query = $ci->m_grup->get(["id" => $id]);
		$result = $query->num_rows();
		if ($result < 1) {
			redirect("admin/auth/blocked");
		}
	}
}

if (!function_exists("cek_akses")) {
	function cek_akses($menuId, $level) {
		$ci = get_instance();
		$where = [
			"menu_id" => $menuId,
			"level" => namaTag($level),
		];
		$result = $ci->db->get_where("user_akses_menu", $where);
		if ($result->num_rows() > 0) {
			echo "checked='checked'";
		}
	}
}

if (!function_exists("cek_akses_sub")) {
	function cek_akses_sub($subId, $level) {
		$ci = get_instance();
		$where = [
			"sub_menu_id" => $subId,
			"level" => namaTag($level),
		];
		$result = $ci->db->get_where("user_akses_sub_menu", $where);
		if ($result->num_rows() > 0) {
			echo "checked='checked'";
		}
	}
}