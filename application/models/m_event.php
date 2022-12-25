<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_event extends CI_Model {
     private $table = "event";
     private $table_story = "love_story";
     private $table_gallery = "gallery";
     private $table_comment = "comment";
     private $order_story = [null, 'title', null, 'sort', 'position', null];
     private $order_gallery = [null, null, null, null, null];
     private $order_comment = [null, 'name', null, 'date_added', null];

     public function get($where = null) {
          $this->db->select("$this->table.*, b.name, b.image");
          $this->db->join('bank b', "b.id = $this->table.bank_id", 'left');
          if ($where) $this->db->where($where);
          return $this->db->get($this->table)->row();
     }

     public function get_undangan($where = null) {
          if ($where) $this->db->where($where);
          return $this->db->get('undangan_terkirim')->row();
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
               } else {
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

     public function getComment($where = null, $start = null) {
          if ($where) $this->db->where($where);
          $this->db->order_by('id', 'desc');
          $starter = !$start ? 1 : $start;
          $this->db->limit($starter, 10);
          return $this->db->get('comment')->result();
     }

     public function get_all_bank($where = null) {
          if ($where) $this->db->where($where);
          $this->db->order_by('name', 'asc');
          return $this->db->get('bank')->result();
     }

     public function get_comment($where = null, $limit = []) {
          if ($where) $this->db->where($where);
          $this->db->order_by('id', 'desc');
          $this->db->where('event_id', 1);
          // if ($limit) {
          //      $start = $limit['start'];
          //      $end = $limit['end'];
          // } else {
          //      $start = 0;
          //      $end = 5;
          // }
          // $this->db->limit($end, $start);
          return $this->db->get('comment')->result();
     }

     private function _query_comment() {
          $this->db->from($this->table_comment);
          $this->db->where('isDelete', 0);
          if ($this->input->post('search')['value']) {
               $this->db->like('name', $this->input->post('search')['value']);
               $this->db->or_like('message', $this->input->post('search')['value']);
          }

          if ($this->input->post('order')) {
               if ($this->order[$this->input->post('order')['0']['column']] != null) {
                    $this->db->order_by( 
                         $this->order_comment[$this->input->post('order')['0']['column']], 
                         $this->input->post('order')['0']['dir'] 
                    );
               } else {
                    $this->db->order_by('id','desc');
               }
          } else {
               $this->db->order_by('id','desc');
          }
     }

     public function comment($where = null) {
          $this->_query_comment();
          if ($where) $this->db->where($where);
          if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
          $query = $this->db->get();
          return $query->result();
     }

     public function count_comment() {
          $this->_query_comment();
          $query = $this->db->get();
          return $query->num_rows();
     }

     public function count_all_comment() {
          $this->db->from($this->table_comment);
          $this->db->where('isDelete', 0);
          return $this->db->count_all_results();
     }
}