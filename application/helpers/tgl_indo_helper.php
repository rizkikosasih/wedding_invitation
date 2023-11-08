<?php
if (!function_exists("date_indo")) {
	function date_indo($tanggal) {
		$date = substr($tanggal, 0, 10);
		$ubah = gmdate($date, time() + 60 * 60 * 8);
		$ex = explode("-", $ubah);
		$tgl = $ex[2];
		$bln = bulan($ex[1]);
		$thn = $ex[0];
		return "$tgl $bln $thn";
	}
}

if (!function_exists("bulan")) {
	function bulan($bln) {
		$a_bulan = [1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		return $a_bulan[intval($bln)];
	}
}

//Format Shortdate
if (!function_exists("shortdate_indo")) {
	function shortdate_indo($tanggal) {
		$date = substr($tanggal, 0, 10);
		$ubah = gmdate($date, time() + 60 * 60 * 8);
		$ex = explode("-", $ubah);
		$tgl = $ex[2];
		$bln = short_bulan($ex[1]);
		$thn = $ex[0];
		return "$tgl/$bln/$thn";
	}
}

if (!function_exists("short_bulan")) {
	function short_bulan($bln) {
		$a_bulan_short = [1 => "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
		return $a_bulan_short[intval($bln)];
	}
}

//Format Medium date
if (!function_exists("mediumdate_indo")) {
	function mediumdate_indo($tanggal) {
		$date = substr($tanggal, 0, 10);
		$ubah = gmdate($date, time() + 60 * 60 * 8);
		$ex = explode("-", $ubah);
		$tgl = $ex[2];
		$bln = medium_bulan($ex[1]);
		$thn = $ex[0];
		return "$tgl $bln $thn";
	}
}

if (!function_exists("medium_bulan")) {
	function medium_bulan($bln) {
		$a_bulan = [1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
		return substr($a_bulan[intval($bln)], 0, 3);
	}
}

//Long date indo Format
if (!function_exists("longdate_indo")) {
	function longdate_indo($tanggal) {
		$date = substr($tanggal, 0, 10);
		$hari = [1 => "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
		$num = date("N", strtotime($tanggal));
		$nama_hari = $hari[$num];
		return $nama_hari . ", " . date_indo($date);
	}
}

//bulan romawi
if (!function_exists("romawi_bulan")) {
	function romawi_bulan($bln) {
		$a_bulan_romawi = [1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
		return $a_bulan_romawi[intval($bln)];
	}
}