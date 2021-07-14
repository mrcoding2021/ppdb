<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('Model_global', 'M_global');
		$this->load->helper('rupiah');
		$this->load->helper('tgl_indo');
		$this->load->helper('terbilang');
	}

	public function index()
	{
		$id = $this->session->userdata('id');
		if ($id) {
			# code...
			$level = $this->session->userdata('level');
			$table = 'tb_user';

			$query = "SELECT `id_user`, `menu`
			  FROM `tb_user_menu` JOIN `tb_menu_acces` 
				ON `tb_user_menu`.`id_user` = `tb_menu_acces`.`menu_id`
			  WHERE `tb_menu_acces`.`role_id`= $level
			ORDER BY `tb_menu_acces`.`menu_id` ASC";

			$data['admin'] = $this->db->query($query)->result_array();
			$data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
			$data['title'] = $data['user']['nama'];
			$this->db->select_sum('kredit', 'total');
			$this->db->where('acc', 1);
			$this->db->where('kategori', 0);
			$data['pemasukan'] = $this->db->get('tb_pembayaran')->row();

			$this->db->select_sum('kredit', 'total');
			$this->db->where('acc', 1);
			$this->db->where('kategori', 1);
			$this->db->where('created_at', date('Y-m-d'));
			$data['pengeluaran'] = $this->db->get('tb_pembayaran')->row();

			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_dashboard', $data);
			$this->load->view('admin/footer', $data);
		} else {
			redirect('home');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}

	public function menu()
	{
		$id = $this->session->userdata('id');
		if ($id) {
			$level = $this->session->userdata('level');
			$table = 'tb_user';
			$query = "SELECT `id_user`, `menu`
			  FROM `tb_user_menu` JOIN `tb_menu_acces` 
				ON `tb_user_menu`.`id_user` = `tb_menu_acces`.`menu_id`
			  WHERE `tb_menu_acces`.`role_id`= $level
			ORDER BY `tb_menu_acces`.`menu_id` ASC";

			$data['title'] = 'Menu';
			$data['admin'] = $this->db->query($query)->result_array();
			$data['menu'] = $this->db->get('tb_menu')->result_array();
			$data['akses'] = $this->db->get('tb_user_menu')->result();
			$data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
			$this->load->view('admin/header', $data);
			$this->load->view('admin/v_menu', $data);
			$this->load->view('admin/footer', $data);
		} else {
			redirect('home');
		}
	}
}
