<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class wedding_invite extends CI_Controller {
     private $dir_img = 'assets/public/images';
     public function __construct() {
          parent::__construct();
          $this->load->model(['m_event', 'm_master']);
     }

     public function index () {
          redirect('wedding_invite/to');
     }

     public function to($name='Unknown Name') {
          $event = $this->m_event->get(['event.id' => 1]);
          $data = [
               'dir_img' => $this->dir_img,
               'e' => $event,
               'love_story' => $this->m_event->get_all_story($event->id),
               'gallery' => $this->m_event->get_all_gallery($event->id),
               'comment' => $this->m_event->get_comment(['isDelete' => 0]),
               'invitedName' => $name,
          ];
          $this->load->view('frontend/wedding_invite/index', $data);
     }

     public function add_comment() {
          $name = ucwords($this->input->post('name'));
          $message = htmlentities($this->input->post('message'));
          $data = [
               'event_id' => 1,
               'name' => $name,
               'message' => $message,
               'date_added' => hari_lengkap()
          ];
          $this->m_master->add('comment', $data);
          $comment = $this->m_event->get_comment(['isDelete' => 0]);
          $newComment = [];
          foreach ($comment as $c) {
               $newComment[] = [
                    'id' => $c->id,
                    'name' => $c->name,
                    'message' => html_entity_decode($c->message),
                    'date_added' => $c->date_added,
               ];
          }
          $result = [
               'response' => 200,
               'status' => 'SUKSES',
               'message' => 'Terima Kasih ' . $name,
               'data' => $newComment,
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }

     public function list_comment() {
          $comment = $this->m_event->get_comment(['isDelete' => 0]);
          $lastId = !$_GET['lastId'] ? 0 : $_GET['lastId'];
          if ($comment[0]->id != $lastId) {
               $newComment = $this->m_event->get_comment([
                    'isDelete' => 0,
                    'id >' => $lastId,
               ]);
          } else {
               $newComment = [];
          }
          $result = [
               'response' => 200,
               'status' => 'SUKSES',
               'data' => $newComment,
          ];
          $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode($result))
          ->set_status_header(200);
     }
}