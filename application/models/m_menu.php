<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_menu extends CI_Model
{
    private $table = "menu";

    private $order = [ 
        null,
        "mu.nama_menu",
        "menu.nama_menu",
        "menu.urutan",
        null,
        "menu.url",
        "menu.tipe",
        null,
        null,
        null,
    ];

    public function get( $where = null )
    {
        if( !empty($where) ){
            $this->db->where($where);
            $this->db->order_by("nama_menu","asc");
        }else{
            $this->db->order_by("tipe,nama_menu","asc");
        }

        return $this->db->get($this->table);
    } 

    public function get_akses($where=null)
    {
        if($where){
            $this->db->where($where);
        }
        return $this->db->get('akses_menu');
    } 

    public function menuFront( $where = null )
    {
        
        if( $where ){
            $this->db->where($where);
        }

        $this->db->order_by('urutan','asc');

        return $this->db->get($this->table);
    } 

    public function menuBack( $where = null )
    {
        $this->db->select("m.*");
        $this->db->join('akses_menu am', 'am.menu_id = m.id', 'left');
        if( $where ){
            $this->db->where($where);
        }
        $this->db->order_by('m.urutan, m.nama_menu', 'ASC');
        return $this->db->get("$this->table m");
    } 

    private function _get_data_query()
    {
        $this->db->select("$this->table.*");
        $this->db->select("mu.nama_menu as menu_utama");
        $this->db->from($this->table);
        $this->db->join("menu mu", "mu.id=$this->table.induk_id","left");
        $this->db->where("$this->table.isDelete", 0);

        if( !empty($this->input->post('search')['value']) )
        {
            $this->db->like("$this->table.nama_menu", $this->input->post('search')['value']);
            $this->db->or_like("$this->table.url", $this->input->post('search')['value']);
            $this->db->or_like("$this->table.tipe", $this->input->post('search')['value']);
            $this->db->or_like("mu.nama_menu", $this->input->post('search')['value']);
        }

        if( !empty($this->input->post('order')) )
        {
            if( $this->order[$this->input->post('order')['0']['column']] != null ){
                $this->db->order_by( 
                    $this->order[$this->input->post('order')['0']['column']], 
                    $this->input->post('order')['0']['dir'] 
                );
            }else{
                $this->db->order_by('nama_menu','asc');
            }
        }
        else
        {
            $this->db->order_by("$this->table.nama_menu",'asc');
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