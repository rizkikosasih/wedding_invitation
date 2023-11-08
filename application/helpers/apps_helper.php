<?php
if (!function_exists("rupiah")) {
	function rupiah($angka) {
		$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
		return $hasil_rupiah;
	}
}

if (!function_exists("rp")) {
	function rp($angka) {
		$hasil_rupiah = number_format($angka,0,',','.');
		return $hasil_rupiah;
	}
}

if (!function_exists("randColor")) {
	function randColor() {
		return '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
	}
}

if (!function_exists("newAlamat")) {
	function newAlamat($text) {
		$awal = array("<p>", "</p>");
		$akhir = array("<div>", "</div>");
		$replace = str_replace($awal, $akhir, $text);
		return $replace;
	}
}

if (!function_exists("htmlChange")) {
	function htmlChange($text) {
		$awal = array("<p>", "</p>", "\r\n");
		$akhir = array("<div>", "</div>", "<br>");
		$replace = htmlentities(str_replace($awal, $akhir, $text));
		return $replace;
	}
}

if (!function_exists("escaped")) {
	function escaped($text) {
		$ci = get_instance();
		return $ci->db->escape($text);
	}
}

if (!function_exists("encode64")) {
	function encode64($string, $base64=true) {
		$encrypt_method = "AES-256-CBC";
		$secret_key = "Scr546key";
		$secret_iv = "Scr546iv";
		// hash
		$key = hash("sha256", $secret_key);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash("sha256", $secret_iv), 0, 16);
		$isData = is_array($string) || is_object($string) ? json_encode($string) : $string;
		$output = openssl_encrypt($isData, $encrypt_method, $key, 0, $iv);
		if (!$base64) {
			return str_replace("=", "", base64_encode($output));
		} else {
			return str_replace("=", "", base64_encode($isData));
		}
	}
}

if (!function_exists("decode64")) {
	function decode64($string, $base64=true) {
		$encrypt_method = "AES-256-CBC";
		$secret_key = "Scr546key";
		$secret_iv = "Scr546iv";
		// hash
		$key = hash("sha256", $secret_key);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash("sha256", $secret_iv), 0, 16);
		if (!$base64) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		} else {
			$output = base64_decode($string);
		}
		return json_validator($output) ? json_decode(stripslashes($output)) : $output;
	}
}

if (!function_exists("no_hp")) {
	function no_hp($angka=0, $jml=4, $opt="-") {
		$data = "";
		$i = 0;
		foreach(str_split($angka) as $key => $value) {
			$str = "";
			if ($i == $jml) {
				$str = $opt;
				$i = 0;
			}

			$data .= $str . $value;
			$i++;
		}
		return $data;
	}
}

if (!function_exists("deskripsi")) {
	function deskripsi($kata, $limit = 50) {
		if (strlen(strip_tags($kata)) < $limit) {
			return strip_tags($kata);
		} else {
			return substr(strip_tags($kata), 0, $limit) . " ...";
		}
	}
}

if (!function_exists("dateTimeNow")) {
	function dateTimeNow() {
		return date("Y-m-d H:i:s");
	}
}

if (!function_exists("dateNow")) {
	function dateNow() {
		return date("Y-m-d");
	}
}

if (!function_exists("timeNow")) {
	function timeNow() {
		return date("H:i:s");
	}
}

if (!function_exists("yearsNow")) {
	function yearsNow() {
		return date("Y");
	}
}

if (!function_exists("dateOnly")) {
	function dateOnly($text) {
		return substr($text, 0, 10);
	}
}

if (!function_exists("timeOnly")) {
	function timeOnly($text, $batas="8") {
		return substr($text, 11, $batas);
	}
}

if (!function_exists("dateRetreat")) {
	function dateRetreat($date, $number="") {
		$ex = explode("-", dateOnly($date));
		$d = $ex[2];
		$m = $ex[1];
		$y = $ex[0];
		$numbers = !$number ? 7 : $number;

		return date("Y-m-d", mktime(0, 0, 0, $d, $m - $numbers, $y));
	}
}

if (!function_exists("dateDifference")) {
	function dateDifference($start, $end) {
		$start1 = strtotime($start);
		$end1 = strtotime($end);
		$diff = $tgl2 - $tgl1;
		return ($diff / 60 / 60 / 24);
	}
}

if (!function_exists("createToken")) {
	function createToken() {
		$token = base64_encode(password_hash(dateTimeNow() . rand(1,99999), PASSWORD_DEFAULT));
		$remake = str_replace(["$", "/", ".", " ", "="], ["", "", "", "", ""], $token);
		return substr(strtoupper(stripslashes(strip_tags($remake))), 0, 6);
	}
}

if (!function_exists("fileName")) {
	function fileName($text) {
		return strtolower(str_replace(" ", "_", $text));
	}
}

if (!function_exists("namaTag")) {
	function namaTag($text=null) {
		return strtolower(str_replace(" ", "_", $text));
	}
}

if (!function_exists("sectionName")) {
	function sectionName($text) {
		return str_replace(" ", "-", strtolower($text));
	}
}

if (!function_exists("users")) {
	function users($ids="") {
		$ci =& get_instance();
		$id = $ids ?: $ci->session->userdata("id");
		$query = $ci->db->get_where("user", [ "id" => $id ]);
		if ($query->num_rows() < 1) {
			return null;
		} else {
			return $query->row();
		}
	}
}

if (!function_exists("sessId")) {
	function sessId() {
		$ci =& get_instance();
		$id = users()->id;
		$pengacak = "acak";
		$pass = md5($pengacak . $id . $pengacak);
		$filter = stripslashes(strip_tags(htmlspecialchars($pass, ENT_QUOTES)));
		$banArray = array("\x00", "\\", "\0", "\n", "\r", "'", '"', "\x1a", "=");
		return str_replace($banArray, "", $filter);
	}
}

if (!function_exists("invoice")) {
	function invoice($type, $pembatas="/") {
		$ci =& get_instance();
		$m = romawi_bulan(date("m"));
		$y = date("Y");
		$getId = $ci->db->select("max(id) as last_id");
		if ($type == "in") {
			$type = "M";
			$getId = $ci->db->get("pemesanan");
		} elseif ($type == "out") {
			$type = "K";
			$getId = $ci->db->get("pemesanan");
		} else {
			return "Gagal Membuat Invoice";
		}
		$d = $getId->row();
		if (!$d->last_id) {
			$lastId = 1;
		} else {
			$lastId = $d->lastId + 1;
		}
		return sprintf("%s$pembatas%s$pembatas%s$pembatas%s", $type, $tahun, $bulan, $lastId);
	}
}

if (!function_exists("statis")) {
	function statis($jenis, $section) {
		# parameter 1 jenisnya back atau front
		# parameter 2 nama dari section
		$ci =& get_instance();
		$where = ["jenis" => $jenis, "section" => $section, "isActive" => 1];
		$data = $ci->db->get_where("halaman_statis", $where)->row();
		return $data->isi ?: null;
	}
}

if (!function_exists("nama_pt")) {
	function nama_pt() {
		return statis('b', 'nama-pt');
	}
}

if (!function_exists("alamat_pt")) {
	function alamat_pt() {
		return statis('b', 'alamat-pt');
	}
}

if (!function_exists("inisial")) {
	function inisial() {
		$ins = strip_tags(statis('b', 'inisial-pt'));
		return strtoupper($ins);
	}
}

if (!function_exists("tema")) {
	function tema($type = "") {
		$theme = users()->tema;
		$warnaTxt = $theme == "dark-mode" ? "text-light" : "text-light";
		$navbar = $theme == "dark-mode" ? "navbar-dark navbar-navy" : "navbar-dark navbar-navy";
		$sidebar = $theme == "dark-mode" ? "sidebar-dark-navy" : "sidebar-light-navy";
		$output = [
			"txt" => $warnaTxt,
			"navbar" => $navbar,
			"sidebar" => $sidebar
		];
		return $type ? $output[$type] : $theme;
	}
}

if (!function_exists("emptyContent")) {
	function emptyContent($pesan="") {
		$msg = $pesan ?: "Something went error";
		return
		"<div class='col-sm-12' style='font-family:courgette;'>
			<div class='text-center'>
				<i class='far fa-dizzy fa-10x mt-3 mb-3'></i>
				<h1>$msg</h1>
				<a href='".base_url("home")."' class='mt-3 mb-3 btn btn-outline-dark'>
				Kembali Ke Halaman Home
				</a>
			</div>
		</div>";
	}
}

if (!function_exists("emptyModal")) {
	function emptyModal($pesan) {
		$msg = $pesan ?: "Something went error";
		return
		"<div class='modal-body'>
			<div class='text-center'>
				<i class='far fa-dizzy fa-10x mb-3'></i>
				<h3>$pesan</h3>
			</div>
		</div>";
	}
}

if (!function_exists("menus")) {
	function menus($id) {
		$ci =& get_instance();
		$ci->load->model("m_menu");

		return $ci->m_menu->get(["id" => $id])->row();
	}
}

if (!function_exists("grupDet")) {
	function grupDet($id=null) {
		$ci =& get_instance();
		return $id ? $ci->db->get_where("grup", ["id" => $id])->row() : null;
	}
}

if (!function_exists("getDates")) {
	function getDates($type=null, $date) {
		$data = [
			"date" => [
				"start" => 0,
				"end" => 10,
			],
			"day" => [
				"start" => 8,
				"end" => 2,
			],
			"month" => [
				"start" => 5,
				"end" => 2,
			],
			"years" => [
				"start" => 0,
				"end" => 4,
			],
			"time" => [
				"start" => 11,
				"end" => 5,
			],
			"time_full" => [
				"start" => 11,
				"end" => 8,
			],
		];
		if (!$type) return null;
		if (!array_key_exists($type, $data)) return null;
		return substr($date, $data[$type]['start'], $data[$type]['end']);
	}
}

if (!function_exists("checkDates")) {
	function checkDates($date) {
		if (!strtotime($date)) {
			return date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 7, date("Y")));
		} else {
			return substr($date, 0, 10);
		}
	}
}

if (!function_exists("checkTime")) {
	function checkTime($dates) {
		if (getDates("time", $dates) == '00:00') {
			$date = new DateTime(date('Y-m-d H:i:s'));
		} else {
			$date = new DateTime(date($dates));
		}
		return $date->format('h:i A');
	}
}

if (!function_exists("nameDate")) {
	function nameDate($date) {
		$i = date("D", strtotime($date));
		$dayList = [
			"Sun" => "Minggu",
			"Mon" => "Senin",
			"Tue" => "Selasa",
			"Wed" => "Rabu",
			"Thu" => "Kamis",
			"Fri" => "Jumat",
			"Sat" => "Sabtu"
		];
		return $dayList[$i];
	}
}

if (!function_exists("newPhone")) {
	function newPhone($phone) {
		$first = substr($phone, 0, 1);
		$second = substr($phone, 0, 2);
		if (!$first) return 62 . ltrim($phone, 0);
		if ($second == 62) return $phone;
		if ($first == 8) return 62 . $phone;
		return null;
	}
}

if (!function_exists("remakeTemplate")) {
	function remakeTemplate($default, $change, $text) {
		for ($i = 0; $i < count($default); $i++) {
			$text = str_replace($default[$i], $change[$i], $text);
		}
		return str_replace('&amp;', '%26', $text);
	}
}

if (!function_exists("initialName")) {
	function initialName($name) {
		$words = explode(" ", $name);
		if (count($words) >= 2) {
			return mb_strtoupper(
				mb_substr($words[0], 0, 1, 'UTF-8') . mb_substr(end($words), 0, 1, 'UTF-8'), 'UTF-8'
			);
		} else {
			preg_match_all('#([A-Z]+)#', $name, $capitals);
			if (count($capitals[1]) >= 2) {
				return mb_substr(implode('', $capitals[1]), 0, 2, 'UTF-8');
			}
			return mb_strtoupper(mb_substr($name, 0, 2, 'UTF-8'), 'UTF-8');
		}
	}
}

if (!function_exists("randClass")) {
	function randClass() {
		$i = rand(0, 6);
		$obj = ["success", "danger", "warning", "info", "dark", "primary", "secondary"];
		return 'bg-' . $obj[$i];
	}
}

if (!function_exists("isNull")) {
	function isNull($text) {
		return $text === null || preg_match("/^ *$/", $text) !== null;
	}
}

if (!function_exists("_xss")) {
	function _xss($method="post", $inputname) {
		$ci =& get_instance();
		if ($method == "post") {
			$text = $ci->input->post($inputname) ?: $_POST[$inputname];
		} elseif ($method == "get") {
			$text = $ci->input->get($inputname) ?: $_GET[$inputname];
		} elseif ($method == "session") {
			$text = $ci->session->$inputname;
		} else {
			$text = $inputname;
		}
		return $ci->security->xss_clean($text);
	}
}

if (!function_exists("to_object")) {
	function to_object($array) {
		return json_decode(json_encode($array));
	}
}

if (!function_exists("json_validator")) {
	function json_validator($data) {
		if (!empty($data)) {
			return is_string($data) && is_array(json_decode($data, true)) ? true : false;
		}
		return false;
	}
}