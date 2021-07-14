<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Simpanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_global', 'mapp');
    }

    public function index()
    {
        $data['title'] = 'Produk Simpanan';
        $data['parent'] = 'Produk';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 43))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/simpanan', $data);
        $this->load->view('template/footer');
    }


    public function simpro()
    {
        $data['title'] = 'Simpanan Produktif';
        $data['parent'] = 'Produk Simpanan';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/simpro', $data);
        $this->load->view('template/footer');
    }

    public function siroh()
    {
        $data['title'] = 'Simpanan Umroh';
        $data['parent'] = 'Produk Simpanan';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/siroh', $data);
        $this->load->view('template/footer');
    }

    public function siji()
    {
        $data['title'] = 'Simpanan Haji';
        $data['parent'] = 'Produk Simpanan';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/siji', $data);
        $this->load->view('template/footer');
    }
    public function siwaq()
    {
        $data['title'] = 'Simpanan Wisata Qurani';
        $data['parent'] = 'Produk Simpanan';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/siwaq', $data);
        $this->load->view('template/footer');
    }

    public function sisuka()
    {
        $data['title'] = 'Simpanan Sukarela';
        $data['parent'] = 'Produk Simpanan';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $data['mitra'] = $this->mapp->get_all('tb_mitra')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/sisuka', $data);
        $this->load->view('template/footer');
    }

    public function saqu()
    {
        $data['title'] = 'Simpanan Qurban';
        $data['parent'] = 'Produk Simpanan';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/saqu', $data);
        $this->load->view('template/footer');
    }

    public function sidik()
    {
        $data['title'] = 'Simpanan Pendidikan';
        $data['parent'] = 'Produk Simpanan';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/sidik', $data);
        $this->load->view('template/footer');
    }

    public function sinar()
    {
        $data['title'] = 'Simpanan Nikah dan Resepsi';
        $data['parent'] = 'Produk Simpanan';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/sinar', $data);
        $this->load->view('template/footer');
    }

    public function akad()
    {
        $data['title'] = 'Akad-akad Syariah';
        $data['parent'] = 'Produk Simpanan';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/akad-syariah', $data);
        $this->load->view('template/footer');
    }

    public function wajib()
    {
        $data['title'] = 'Simpanan Wajib';
        $data['parent'] = 'Produk Wajib';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/wajib', $data);
        $this->load->view('template/footer');
    }

    public function pokok()
    {
        $data['title'] = 'Simpanan Pokok';
        $data['parent'] = 'Produk Pokok';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $this->db->order_by('id_menu', 'DESC');
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 23))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/pokok', $data);
        $this->load->view('template/footer');
    }
}
