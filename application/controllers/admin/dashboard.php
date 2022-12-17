<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {
     private $url;

     public function __construct() {
          parent::__construct();
          $this->load->model([
               'm_user',
          ]);
          $this->url = 'admin/' . $this->uri->segment(2);
          cek_login();
     }

     public function index() {
          $data = [
               'user' => users(), 
               "content" => "$this->url/index",
               'judul' => 'Dashboard', 
               'curMenu' => 'Dashboard', 
               "url" => $this->url,
          ];
          $this->load->view('templates/admin/main-app', $data);
     }
}