<?php

    function rupiah($angka) {
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function rp($angka) {
        $hasil_rupiah = number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function rand_color() {
        return '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }

    function newAlamat($text) {
        $awal = array(
            '<p>',
            '</p>'
        );
        $akhir = array(
            '<div>',
            '</div>'
        );
        $replace = str_replace($awal, $akhir, $text);
        return $replace;
    }

    function htmlChange($text) {
        $awal = array(
            '<p>',
            '</p>',
            '\r\n',
        );
        $akhir = array(
            '<div>',
            '</div>',
            '<br>',
        );
        $replace = htmlentities(str_replace($awal, $akhir, $text));
        return $replace;
    }

    function escaped($text) {
        $ci = get_instance();
        return $ci->db->escape($text);
    } 

    function encode64($text) {
        $pengacak = "AsU";
        $data = base64_encode($text . "-" . $pengacak);
        $match = ['=', '"', "'"];
        $change = ['', '*', '^'];
        $output = str_replace($match, $change, $data);
        return $output;
    }

    function decode64($text) {
        $pengacak = "AsU";
        $match = ['*', '^'];
        $change = ['"', "'"];
        $data = str_replace($match, $change, $text);
        $decode = base64_decode($data);
        $explode = explode('-', $decode);
        $output = $explode[1] != $pengacak ? 'undefined' : $explode[0];
        return $output;
    }

    function no_hp($angka=0, $jml=4, $opt='-') {
    
        $data = '';

        $i = 0;

        foreach( str_split($angka) as $key => $value ):
            if($i == $jml) {
                $str = $opt;
                $i = 0;
            } else {
                $str = '';
            }
            
            $data .= $str . $value;
            $i++;
        endforeach;

        return $data;
    }

    function deskripsi($kata, $limit = 50) {
        if( strlen(strip_tags($kata)) < $limit ): //jika jumlah kata lebih kecil dari limit
            $output = strip_tags($kata);
        else: //jika tidak
            $output = substr(strip_tags($kata),0,$limit) . " ...";
        endif;

        return $output;
    }

    function hari_lengkap() {
        return date('Y-m-d H:i:s');
    }

    function hari() {
        return date('Y-m-d');
    }

    function jam() {
        return date('H:i:s');
    }

    function years() {
        return date('Y');
    }

    function date_only($text) {
        return substr($text,0,10);
    }

    function time_only($text, $batas='8') {
        $b = empty($batas) ? 8 : $batas;
        return substr($text,11,$b);
    }

    function tgl_mundur($tgl,$number="") {
        $pecah = explode('-',$tgl);
        $hari = $pecah[2];
        $bulan = $pecah[1];
        $tahun = $pecah[0];
        $numbers = empty($number) ? 7 : $number;

        return date('Y-m-d', mktime(0,0,0, $bulan, $hari - $numbers, $tahun));
    }

    function selisih($awal,$akhir) {
        $tgl1 = strtotime($awal); 
        $tgl2 = strtotime($akhir); 

        $jarak = $tgl2 - $tgl1;

        $hari = $jarak / 60 / 60 / 24;
        return $hari;
    }

    function tujuh_hari($text) {
        $pecah = explode('-',$text);
        $hari = $pecah[2];
        $bulan = $pecah[1];
        $tahun = $pecah[0];

        return date('Y-m-d', mktime(0,0,0, $bulan, $hari - 7, $tahun));
    }

    function buatToken() {
        $token = base64_encode(password_hash( hari_lengkap() . rand(1,99999), PASSWORD_DEFAULT ));
        $remake = str_replace( [ '$', '/', '.', ' ', '=' ], '' , $token);
        $last = stripslashes( strip_tags( $remake ) );
        return $last;
    }

    function fileName($text) {
        return strtolower( str_replace(" ","_",$text) );
    }

    function nama_tag($text=null) {
        return strtolower(str_replace(' ','_',$text));
    }

    function section_name($text) {
        return str_replace( ' ', '-', strtolower($text));
    }

    function nama_pt() {
        return statis('b','nama-pt');
    }

    function alamat_pt() {
        return statis('b','alamat-pt');
    }

    function inisial() {
        $ins = strip_tags(statis('b','inisial-pt'));
        return strtoupper($ins);
    }

    function users($ids="") {
        $ci =& get_instance();
        $id = !empty($ids) ? $ids : $ci->session->userdata('id');
        $query = $ci->db->get_where( 'user', [ "id" => $id ] );
        if( $query->num_rows() < 1 ){
            return "";
        }else{
            return $query->row();
        }
    }

    function sesi_id() {
        $ci =& get_instance();
        $id = users()->id;
        $pengacak = "acak";
        $pass = md5( $pengacak . $id . $pengacak );
        $filter = stripslashes(strip_tags(htmlspecialchars($pass,ENT_QUOTES)));
        $banArray = array("\x00", "\\", "\0", "\n", "\r", "'", '"', "\x1a", "=");
        return str_replace($banArray,' ',$filter);
    }

    function invoice($jenis,$pembatas="/") {
        $ci =& get_instance();
        $bulan = romawi_bulan(date('m'));
        $tahun = date('Y');
        $ins = inisial();

        $getId = $ci->db->select("max(id) as last_id");

        if( $jenis == 'in' ) {
            $type = "M";
            $getId = $ci->db->get('pemesanan');
        } elseif( $jenis == 'out' ) {
            $getId = $ci->db->get('pemesanan');
            $type = "K";
        } else {
            return "Gagal Membuat Invoice";
        }
        $d = $getId->row();

        if( empty($d->last_id) || !isset($d) ){
            $lastId = 1;
        }else{
            $lastId = $d->last_id+1;
        }

        return $ins . $pembatas . $type . $pembatas . $tahun . $pembatas . $bulan . $pembatas . $lastId;
    }

    function inv($pembatas="-") {
        $ci =& get_instance();
        $bulan = romawi_bulan(date('m'));
        $tahun = date('Y');
        $ins = inisial();

        $getId = $ci->db->select("max(id) as last_id");

        $getId = $ci->db->get('pemesanan');

        $d = $getId->row();

        if( empty($d->last_id) || !isset($d) ){
            $lastId = 1;
        }else{
            $lastId = $d->last_id+1;
        }

        return $ins . $pembatas . $tahun . $pembatas . $bulan . $pembatas . $lastId;
    }

    function kodePaket($table,$pembatas="-") {
        $ci =& get_instance();
        $ins = inisial();
        $ci->db->select("max(id) as lastId");
        $d = $ci->db->get($table)->row();
        if( isset($d) ){
            $lastId = $d->lastId + 1;
        }else{
            $lastId = 1;
        }
        return $ins . $pembatas . $lastId;
    }

    function statis( $jenis, $section ) {
        # parameter 1 jenisnya back atau front
        # parameter 2 nama dari section
        $ci =& get_instance();
        $where = [
            "jenis" => $jenis,
            "section" => $section,
            "isActive" => 1,
        ];
        $data = $ci->db->get_where('halaman_statis',$where)->row();
        if( isset($data) ){
            return $data->isi;
        }else{
            return "";
        }
    }

    function tema($type = '') {
        $theme = users()->tema;
        $warnaTxt = $theme == 'dark-mode' ? 'text-light' : 'text-light';
        $navbar = $theme == 'dark-mode' ? 'navbar-dark navbar-navy' : 'navbar-dark navbar-navy';
        $sidebar = $theme == 'dark-mode' ? 'sidebar-dark-navy' : 'sidebar-light-navy';

        if( $type == 'txt' ){
            return $warnaTxt;
        }elseif( $type == 'navbar' ){
            return $navbar;
        }elseif( $type == 'sidebar' ){
            return $sidebar;
        }else{
            return $theme;
        }
    }

    function emptyContent($pesan) {
        $output = '
        <div class="col-sm-12" style="font-family:courgette;">
        <div class="text-center">
            <i class="far fa-dizzy fa-10x mt-3 mb-3"></i>
            <h1>'.$pesan.'</h1>
            <a href="'.base_url('home').'" class="mt-3 mb-3 btn btn-outline-dark">
            Kembali Ke Halaman Home
            </a>
        </div>
        </div>
        ';

        return $output;
    } 

    function emptyModal($pesan) {
        $output = "
        <div class=\"modal-body\">
            <div class=\"text-center\">
                <i class=\"far fa-dizzy fa-10x mb-3\"></i>
                <h3>$pesan</h3>
            </div>
        </div>
        ";
        return $output;
    }

    function menus($id) {
        $ci =& get_instance();
        $ci->load->model('m_menu');

        return $ci->m_menu->get(['id'=>$id])->row();
    }

    function grupDet($id=null) {
        $ci =& get_instance();
        if( !empty($id) ){
            return $ci->db->get_where('grup', array(
                'id' => $id
            ))->row();
        } else {
            return "";
        }
    }

    function getDates($type=null, $date) {
        $data = [
            'date' => [
                'start' => 0,
                'end' => 10,
            ],
            'day' => [
                'start' => 8,
                'end' => 2,
            ],
            'month' => [
                'start' => 5,
                'end' => 2,
            ],
            'years' => [
                'start' => 0,
                'end' => 4,
            ],
            'time' => [
                'start' => 11,
                'end' => 5,
            ],
            'time_full' => [
                'start' => 11,
                'end' => 8,
            ],
        ];
        if (!$type) return "";
        if (!array_key_exists($type, $data)) return "";
        
        // if ($type === 'date') {
        //     $start = 0;
        //     $end = 11;
        // } else if ($type === 'day') {
        //     $start = 8;
        //     $end = 2;
        // } elseif ($type === 'month') {
        //     $start = 5;
        //     $end = 2;
        // } elseif ($type === 'years') {
        //     $start = 0;
        //     $end = 4;
        // } else if ($type === 'time_full') {
        //     $start = 11;
        //     $end = 8;
        // } else if ($type === 'time') {
        //     $start = 11;
        //     $end = 5;
        // }
        return substr($date, $data[$type]['start'], $data[$type]['end']);
    }

    function checkDates($date) {
        $hari = date('d');
        $bulan = date('m');
        $tahun = date('Y');
        $output = $date == '0000-00-00' ? date('Y-m-d', mktime(0,0,0, $bulan, $hari + 7, $tahun)) : substr($date, 0, 10);
        return $output;
    }

    function checkTime($dates) {
        if (getDates('time', $dates) == '00:00') {
            $date = new DateTime(date('Y-m-d H:i:s'));
        } else {
            $date = new DateTime(date($dates));
        }
        return $date->format('h:i A');
    }

    function nameDate($date) {
        $i = date('D', strtotime($date));
        $dayList = [
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        ];
        return $dayList[$i];
    }

    // function clear_latest_cache() {
    //     $ci =& get_instance();
    //     $ci->load->driver('cache');
    //     $wildcard = 'latest';
    //     $all_cache = $ci->cache->cache_info();
    //     foreach ($all_cache as $id => $cache):
    //         if (strpos($id, $wildcard) !== false):
    //             $ci->cache->delete($cache_id);
    //         endif;
    //     endforeach;
    // }