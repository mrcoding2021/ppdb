<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('Model_global','mapp');
		
	}

	public function index()
	{
		$data['title'] = 'Beranda';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu',array('acces'=>3, 'parent'=>0))->result_array();
		// $data['slider']= $this->mapp->get_all('tb_slider')->result_array();
		// $data['post'] = $this->mapp->get_all('tb_post')->result();
		// $data['logo'] = $this->mapp->get_all('tb_mitra')->result_array();
		$query = 'SELECT * FROM paket ORDER BY id_paket DESC';
		$data['paket'] = $this->db->query($query)->result();
		
		$this->load->view('login',$data);
		
		
	}

	public function sejarah()
	{
		$data['title'] = 'Sekilas Sejarah';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 18))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$data['parent'] = 'Tentang Kami';
		$this->load->view('template/header', $data);
		$this->load->view('template/sejarah', $data);
		$this->load->view('template/footer');
	}

	public function visi_misi()
	{
		$data['title'] = 'Visi dan Misi';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 18))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$data['parent'] = 'Tentang Kami';
		$this->load->view('template/header', $data);
		$this->load->view('template/visi-misi', $data);
		$this->load->view('template/footer');
	}

	public function legalitas()
	{
		$data['title'] = 'Legalitas';
		$data['parent'] = 'Tentang Kami';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 18))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('template/legalitas', $data);
		$this->load->view('template/footer');
	}
	public function struktur()
	{
		$data['parent'] = 'Tentang Kami';
		$data['title'] = 'Struktur';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 18))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('template/struktur', $data);
		$this->load->view('template/footer');
	}

	public function mitra_kerja()
	{
		$data['title'] = 'Mitra Kerja';
		$data['parent'] = 'Tentang Kami';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 18))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$data['mitra'] = $this->mapp->get_all('tb_mitra')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('template/mitra-kerja', $data);
		$this->load->view('template/footer');
	}

	public function kantor()
	{
		$data['title'] = 'Kantor Pelayanan';
		$data['parent'] = 'Tentang Kami';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 18))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('template/kantor', $data);
		$this->load->view('template/footer');
	}


	public function asset(){
		$data['title'] = 'Jual Asset';
		$data['parent'] = '';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0, 'dropdown'=> 0))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('template/kantor', $data);
		$this->load->view('template/footer');
	}

	public function kontak()
	{
		$data['title'] = 'Kontak';
		$data['parent'] = '';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0, 'dropdown' => 0))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('template/kantor', $data);
		$this->load->view('template/footer');
	}

	public function pembiayaan()
	{
		$data['title'] = 'Pembiayaan';
		$data['parent'] = 'Program';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 43))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('pages/pembiayaan', $data);
		$this->load->view('template/footer');
	}

	public function ajukan(){
		$data['title'] = 'Form Pengajuan Pembiayaan';
		$data['parent'] = 'Home';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 43))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('pages/biaya', $data);
		$this->load->view('template/footer');
	}

	public function simpan(){
		$data['title'] = 'Form Pengajuan Produk Simpanan';
		$data['parent'] = 'Home';
		$this->db->order_by('urutan', 'ASC');
		$data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
		$data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 43))->result_array();
		$data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
		$data['post'] = $this->mapp->get_all('tb_post')->result_array();
		$this->load->view('template/header', $data);
		$this->load->view('pages/simpan', $data);
		$this->load->view('template/footer');
	}

	public function kirim(){
		$data = array(
			// Data Pribadi
			'created_at'	=> date('Y-m-d'),
			'jns_biaya'		=>	$_POST['jns_biaya'],
			'pengajuan'		=>	$_POST['pengajuan'],
			'nama'				=>	$_POST['nama'],
			'ttl'					=>	$_POST['ttl'],
			'pendidikan'	=>	$_POST['pendidikan'],
			'ktp'					=>	$_POST['ktp'],
			'npwp'				=>	$_POST['npwp'],
			'sex'					=>	$_POST['sex'],
			'alamat_ktp'	=>	$_POST['alamat_ktp'],
			'tlp_rumah'		=>	$_POST['tlp_rumah'],
			'hp'					=>	$_POST['hp'],
			'domisili'		=>	$_POST['domisili'],
			'lama_tinggal'=>	$_POST['lama_tinggal'],
			'status_rmh'	=>	$_POST['status_rmh'],
			'status_kawin'=>	$_POST['status_kawin'],
			'agama'				=>	$_POST['agama'],
			'ibu'					=>	$_POST['ibu'],

			// Data Pekerjaan 
			'pt'					=>	$_POST['pt'],
			'lama_bekerja'=>	$_POST['lama_bekerja'],
			'divisi'			=>	$_POST['divisi'],
			'atasan'			=>	$_POST['atasan'],
			'alaamat_pt'	=>	$_POST['alaamat_pt'],
			'tlp_pt'			=>	$_POST['tlp_pt'],
			'ext_pt'			=>	$_POST['ext_pt'],
			'hni'					=>	$_POST['hni'],

			// Data Suami Isti
			'nama_istri'					=>	$_POST['nama_istri'],
			'pekerjaan'						=>	$_POST['pekerjaan'],
			'pt_istri'						=>	$_POST['pt_istri'],
			'divisi_istri'				=>	$_POST['divisi_istri'],
			'lama_bekerja_istri'	=>	$_POST['lama_bekerja_istri'],
			'tlp_istri'						=>	$_POST['tlp_istri'],
			'ext_istri'						=>	$_POST['ext_istri'],

			// Data Penghasilan
			'penghasilan'					=>	$_POST['penghasilan'],
			'pengahasilan_add'		=>	$_POST['pengahasilan_add'],
			'ket_usaha'						=>	$_POST['ket_usaha'],
			'penghasilan_istri'		=>	$_POST['penghasilan_istri'],
			'total_penghasilan'		=>	$_POST['total_penghasilan'],
			'family'							=>	$_POST['family'],
			'out_rutin'						=>	$_POST['out_rutin'],
			'hutang'							=>	$_POST['hutang'],
			'sisa'								=>	$_POST['sisa'],

			// Nilai  Pengajuan
			'jumlah_dimohon'		=>	$_POST['jumlah_dimohon'],
			'tenor'							=>	$_POST['tenor'],
			'bayar_perbulan'		=>	$_POST['bayar_perbulan'],

			// Detail Pengajuan
			'tujuan'		=>	$_POST['tujuan'],
			'dp'				=>	$_POST['dp'],
			'agunan'		=>	$_POST['agunan'],

		);

		$this->db->insert('tb_pembiayaan', $data);		
		$this->session->set_flashdata('alert', '<div class="alert alert-success">Selamat Data pengajuan anda telah masuk ke sistem kami</div>');
		redirect('home/ajukan');
	}
}
