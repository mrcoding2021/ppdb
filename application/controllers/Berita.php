<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Model_global', 'mapp');
    }

    public function index()
    {
        $data['title'] = 'Berita KoSPE';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 30))->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $data['parent'] = 'Berita - Galeri';
        $this->load->view('template/header', $data);
        $this->load->view('pages/blog', $data);
        $this->load->view('template/footer');
    }

    public function galeri()
    {
        $data['title'] = 'Galeri';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 30))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $data['parent'] = 'Berita - Galeri';
        $this->load->view('template/header', $data);
        $this->load->view('pages/galeri', $data);
        $this->load->view('template/footer');
    }

    public function unduh()
    {
        $data['title'] = 'Unduh File';
        $data['parent'] = 'Berita - Galeri';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 30))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/unduh', $data);
        $this->load->view('template/footer');
    }

    public function blog()
    {
        $data['parent'] = 'Berita - Galeri';
        $data['title'] = 'Blog Artikel';
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' =>30))->result_array();
        $data['slider'] = $this->mapp->get_all('tb_slider')->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('pages/blog', $data);
        $this->load->view('template/footer');
    }

    public function detail($slug)
    {
        $this->db->order_by('urutan', 'ASC');
        $data['menu'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 0))->result_array();
        $data['about'] = $this->db->get_where('tb_menu', array('acces' => 3, 'parent' => 18))->result_array();
        $data['post'] = $this->mapp->get_all('tb_post')->result_array();
        $this->db->where('slug', $slug);
        $data['detail'] = $this->db->get('tb_post')->row_array();
        $data['title'] = $data['detail']['judul'];
        $this->load->view('template/header', $data);
        $this->load->view('pages/detail', $data);
        $this->load->view('template/footer');
    }
}
