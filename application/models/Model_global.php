<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_global extends CI_Model
{

    public function get_all($table)
    {
        $result = $this->db->get($table)->result();
        return $result;
    }


    public function getBy($table)
    {
        $this->db->where('level', 4);
        $this->db->where('is_active', 1);
        $result = $this->db->get($table)->result();
        return $result;
    }

    public function get_by_id($id,$table)
    {
        return $this->db->get_where($table, array('id_user' => $id))->row();
    }

    public function delete($table,$id){
        $this->db->set('is_active',0);
        $this->db->where('id_user',$id);
        $this->db->update($table);
    }

    public function cari($table,$nama){
        $this->db->like('nama',$nama);
        $this->db->where('level', 4);
        $this->db->where('is_active', 1);
        $result = $this->db->get($table)->result();
        return $result;
    }
}
