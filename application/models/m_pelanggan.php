<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_pelanggan Extends CI_Model
{

     private $table = "pelanggan";

     private $order = [ 
          null, 
          'nama_depan', 
          'nama_belakang', 
          'alamat', 
          'no_hp', 
          null,
          null, 
     ];

     private function _get_data_query()
     {

          $this->db->from($this->table);

          $this->db->where('isDelete', 0);

          if( !empty($this->input->post('search')['value']) )
          {

               $this->db->like('nama_depan', $this->input->post('search')['value']);
               
               $this->db->or_like('nama_belakang', $this->input->post('search')['value']);
               
               $this->db->or_like('alamat', $this->input->post('search')['value']);

          }

          if( !empty($this->input->post('order')) )
          {
               if( $this->order[$this->input->post('order')['0']['column']] != null ){
                    $this->db->order_by( 
                         $this->order[$this->input->post('order')['0']['column']], 
                         $this->input->post('order')['0']['dir'] 
                    );
               }else{
                    $this->db->order_by('id','desc');
               }
          }
          else
          {
               $this->db->order_by('id','desc');
          }

     }

     public function allData()
     {

          $this->_get_data_query();

          if( $this->input->post('length') != -1 )
          {
               $this->db->limit( $this->input->post('length'), $this->input->post('start') );
          }

          $query = $this->db->get();

          return $query->result();

     }

     public function countFilterData()
     {

          $this->_get_data_query();

          $query = $this->db->get();

          return $query->num_rows();

     }

     public function countAllData()
     {

          $this->db->from($this->table);

          return $this->db->count_all_results();

     }

     public function byId($id)
     {
          return $this->db->get_where($this->table,[ 'id' => $id ])->row();
     }

}