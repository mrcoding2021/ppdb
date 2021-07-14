<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_anggota extends CI_Model {
	
	public function allData()
	{
		$query = $this->db->get('anggota'); 
		return $query->result_array();
	}
	
	public function get_count()
	{
		$sql = 'SELECT COUNT(id_anggota) as id_anggota FROM anggota';
		$result = $this->db->query($sql);
		return $result->row()->id_anggota;
	}
}