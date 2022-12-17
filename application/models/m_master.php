<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_master extends CI_Model
{
     #table, where, data

     public function add($table, $data, $result="") {
          $this->db->insert($table,$data);
          if( !empty($result) ){
               return $this->db->insert_id();
          }else{
               return $this->db->affected_rows();
          }
     }

     public function update($table, $where, $data) {
          $this->db->where($where);
          $this->db->update($table,$data);
          return $this->db->affected_rows();
     }

     public function delete($table, $where) {
          $this->db->where($where);
          $this->db->delete($table);
          return $this->db->affected_rows();
     }

}