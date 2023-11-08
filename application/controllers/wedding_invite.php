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

	public function to($name="Unknown Name") {
		$event = $this->m_event->get(["event.id" => 1]);
		$invitedName = str_replace(["-", "+", "%20"], " ", $name);
		$data = [
			"dir_img" => $this->dir_img,
			"e" => $event,
			"love_story" => $this->m_event->get_all_story($event->id),
			"gallery" => $this->m_event->get_all_gallery($event->id),
			"comment" => $this->m_event->get_comment(["isDelete" => 0]),
			"invitedName" => $invitedName,
			"timest" => time()
		];
		$this->load->view('frontend/wedding_invite/index', $data);
	}

	public function add_comment() {
		$name = ucwords($this->input->post("name"));
		$message = _xss("post", "message");
		$this->m_master->add("comment", [
			"event_id" => 1,
			"name" => $name,
			"message" => $message,
			"date_added" => dateTimeNow()
		]);
		$comment = $this->m_event->get_comment(["isDelete" => 0]);
		$newComment = [];
		foreach ($comment as $i => $c) {
			$commentClass = !$i ? "last" : "";
			$commentAttr = !$i ? "data-last='$c->id'" : "";
			$newComment[] = [
				"<div class='d-flex flex-row align-items-baseline comment-box $commentClass' $commentAttr>
					<div class='avatar avatar-comment'>
						". initialName($c->name) ."
					</div>
					<div class='dialogbox w-100'>
						<div class='body'>
							<span class='tip tip-left'></span>
							<div class='message'>
								<div class='fw-bold'>$c->name</div>
								<hr class='solid bc-primary my-1'>
								<span>". html_entity_decode($c->message) ."</span>
							</div>
						</div>
					</div>
				</div>"
			];
		}

		$this->output
		->set_content_type("application/json")
		->set_status_header(200)
		->set_output(json_encode([
			"code" => 0,
			"status" => "OK",
			"message" => "Terima Kasih " . $name,
			"data" => $newComment,
		], 128));
	}

	public function list_comment() {
		$comment = $this->m_event->get_comment(['isDelete' => 0]);
		$lastId = $_GET['lastId'] ?: 0;
		$newComment = [];
		if ($comment[0]->id != $lastId) {
			$comments = $this->m_event->get_comment(['isDelete' => 0, 'id >' => $lastId]);
			foreach ($comments as $i => $c) {
				$commentClass = !$i ? "last" : "";
				$commentAttr = !$i ? "data-last='$c->id'" : "";
				$newComment[] = [
					"<div class='d-flex flex-row align-items-baseline comment-box $commentClass' $commentAttr>
						<div class='avatar avatar-comment'>
							". initialName($c->name) ."
						</div>
						<div class='dialogbox w-100'>
							<div class='body'>
								<span class='tip tip-left'></span>
								<div class='message'>
									<div class='fw-bold'>$c->name</div>
									<hr class='solid bc-primary my-1'>
									<span>". html_entity_decode($c->message) ."</span>
								</div>
							</div>
						</div>
					</div>"
				];
			}
		}

		$this->output
		->set_content_type("application/json")
		->set_status_header(200)
		->set_output(json_encode([
			"code" => 0,
			"status" => "OK",
			"data" => $newComment,
		], 128));
	}
}