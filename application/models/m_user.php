<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_user extends CI_Model
{
    private $table = "user";

    private $order = [ 
        null, 
        'username', 
        'nama', 
        'grup_id', 
        'no_hp', 
        null,
        null, 
    ];

    public function get( $where = null, $or_where = null )
    {
        if( !empty($where) ){
            $this->db->where($where);
        }
        if( !empty($or_where) ){
            $this->db->or_where($or_where);
        }
        return $this->db->get($this->table);
    } 

    private function _get_data_query()
    {

        $this->db->from($this->table);

        if( !empty($this->input->post('search')['value']) )
        {

            $this->db->like('nama', $this->input->post('search')['value']);
            
            $this->db->or_like('no_hp', $this->input->post('search')['value']);
            
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
                $this->db->order_by('nama','asc');
            }
        }
        else
        {
            $this->db->order_by('nama','asc');
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