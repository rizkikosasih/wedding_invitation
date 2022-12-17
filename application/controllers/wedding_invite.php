<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class wedding_invite extends CI_Controller {
     private $dir_img = 'assets/public/images';
     public function __construct() {
          parent::__construct();
          $this->load->model(['m_event']);
     }

     public function index () {
          $event = $this->m_event->get(['event.id' => 1]);
          $data = [
               'dir_img' => $this->dir_img,
               'e' => $event,
               'love_story' => $this->m_event->get_all_story($event->id),
          ];
          $this->load->view('frontend/wedding_invite/index', $data);
     }
}