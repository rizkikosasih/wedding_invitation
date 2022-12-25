<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_sent extends CI_Model {
     private $table = "undangan_terkirim";
     private $order_sent = [null, 'phone', 'name', 'sent', 'date_added', null];

     private function _query_sent() {
          $this->db->from($this->table);
          if ($this->input->post('search')['value']) {
               $this->db->like('name', $this->input->post('search')['value']);
               $this->db->or_like('phone', $this->input->post('search')['value']);
          }

          if ($this->input->post('order')) {
               if ($this->order[$this->input->post('order')['0']['column']] != null) {
                    $this->db->order_by( 
                         $this->order_sent[$this->input->post('order')['0']['column']], 
                         $this->input->post('order')['0']['dir'] 
                    );
               } else {
                    $this->db->order_by('id','desc');
               }
          } else {
               $this->db->order_by('id','desc');
          }
     }

     public function sent($where = null) {
          $this->_query_sent();
          if ($where) $this->db->where($where);
          if ($this->input->post('length') != -1) $this->db->limit($this->input->post('length'), $this->input->post('start'));
          $query = $this->db->get();
          return $query->result();
     }

     public function count_sent() {
          $this->_query_sent();
          $query = $this->db->get();
          return $query->num_rows();
     }

     public function count_all_sent() {
          $this->db->from($this->table);
          return $this->db->count_all_results();
     }
}