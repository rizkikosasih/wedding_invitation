<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_event extends CI_Model {
     private $table = "event";
     private $table_story = "love_story";
     private $table_gallery = "gallery";
     private $order_story = [null, 'title', null, 'sort', 'position', null];
     private $order_gallery = [null, null, null, null, null];

     public function get($where = null) {
          $this->db->select("$this->table.*, b.name, b.image");
          $this->db->join('bank b', "b.id = $this->table.bank_id", 'left');
          $this->db->join('role_event re', "re.event_id = $this->table.id", 'left');
          $this->db->join('user u', "u.id = re.user_id", 'left');
          if ($where) $this->db->where($where);
          return $this->db->get($this->table)->row();
     }

     public function tabList () {
          return $this->db->get('list_tab')->result();
     }

     private function _query_story() {
          $this->db->from($this->table_story);
          $this->db->where('isDelete', 0);
          if ($this->input->post('search')['value']) {
               $this->db->like('title', $this->input->post('search')['value']);
               $this->db->or_like('body', $this->input->post('search')['value']);
          }

          if ($this->input->post('order')) {
               if ($this->order[$this->input->post('order')['0']['column']] != null) {
                    $this->db->order_by( 
                         $this->order_story[$this->input->post('order')['0']['column']], 
                         $this->input->post('order')['0']['dir'] 
                    );
               }else{
                    $this->db->order_by('id','desc');
               }
          } else {
               $this->db->order_by('id','desc');
          }
     }

     public function story($where = null) {
          $this->_query_story();
          if ($where) $this->db->where($where);
          if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
          $query = $this->db->get();
          return $query->result();
     }

     public function count_story() {
          $this->_query_story();
          $query = $this->db->get();
          return $query->num_rows();
     }

     public function count_all_story() {
          $this->db->from($this->table_story);
          $this->db->where('isDelete', 0);
          return $this->db->count_all_results();
     }

     public function get_story($id) {
          $this->db->where('id', $id);
          $this->db->where('isDelete', 0);
          return $this->db->get($this->table_story)->row();
     }
     
     public function get_all_story($event_id, $sort=[]) {
          $this->db->where('event_id', $event_id);
          $this->db->where('isDelete', 0);
          if (!$sort) $this->db->order_by('sort','asc');
          if ($sort) $this->db->order_by($sort['key'], $sort['value']);
          return $this->db->get($this->table_story)->result();
     }

     private function _query_gallery() {
          $this->db->from($this->table_gallery);
          $this->db->where('isDelete', 0);
          if ($this->input->post('search')['value']) {
               $this->db->like('description', $this->input->post('search')['value']);
          }
          $this->db->order_by('id', 'desc');
     }

     public function gallery($where = null) {
          $this->_query_gallery();
          if ($where) $this->db->where($where);
          if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
          $query = $this->db->get();
          return $query->result();
     }

     public function count_gallery() {
          $this->_query_gallery();
          $query = $this->db->get();
          return $query->num_rows();
     }

     public function count_all_gallery() {
          $this->db->from($this->table_gallery);
          $this->db->where('isDelete', 0);
          return $this->db->count_all_results();
     }

     public function get_gallery($id) {
          $this->db->where('id', $id);
          return $this->db->get($this->table_gallery)->row();
     }

     public function get_all_gallery($event_id) {
          $this->db->where('event_id', $event_id);
          $this->db->order_by('id', 'desc');
          return $this->db->get($this->table_gallery)->result();
     }

     public function getStatisTemplate($where = null) {
          if ($where) $this->db->where($where);
          $this->db->order_by('id', 'desc');
          return $this->db->get('statis_template')->result();
     }

     public function getComment($where = null, $start = null) {
          if ($where) $this->db->where($where);
          $this->db->order_by('id', 'desc');
          $starter = !$start ? 1 : $start;
          $this->db->limit($starter, 10);
          return $this->db->get('comment')->result();
     }

     public function getReservation($where = null) {
          if ($where) $this->db->where($where);
          $this->db->order_by('id', 'desc');
          return $this->db->get('reservation')->result();
     }

     public function get_all_bank($where = null) {
          if ($where) $this->db->where($where);
          $this->db->order_by('name', 'asc');
          return $this->db->get('bank')->result();
     }
}