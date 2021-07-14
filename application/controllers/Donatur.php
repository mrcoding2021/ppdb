<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Donatur extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_anggota');
	}


	public function index()
	{
		$data['judul'] = 'Dashboard Admin';
		$data['donatur'] = $this->M_anggota->allData();
		$data['count'] = $this->M_anggota->get_count();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar');
		$this->load->view('index',$data);
		$this->load->view('templates/footer');
		
	}
	public function alldata()
	{
		$data['donatur'] = $this->M_anggota->allData();
		$data['judul'] = 'Data Donatur';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar');
		$this->load->view('member');
		$this->load->view('templates/footer');
	}
	public function transaksi()
	{
		$data['donatur'] = $this->M_anggota->allData();
		$data['judul'] = 'Daftar Transaksi';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/navbar');
		$this->load->view('transaksi');
		$this->load->view('templates/footer');
	}
	public function amilin()
	{
		$data['donatur'] = $this->M_donatur->allData();
		$data['judul'] = 'Data Amilin';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/navbar');
		$this->load->view('amilin');
		$this->load->view('templates/footer');
	}
		public function program()
	{
		$data['donatur'] = $this->M_donatur->allData();
		$data['judul'] = 'Daftar Amilin';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar',$data);
		$this->load->view('templates/navbar');
		$this->load->view('program');
		$this->load->view('templates/footer');
	}

}