<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
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

  public function menu($content, $title)
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
      $data['title'] = $title;
      $data['admin'] = $this->db->query($query)->result_array();
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $this->db->order_by('id_paket', 'DESC');
      $data['produk'] = $this->db->get('paket')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['slider'] = $this->db->get('tb_slider')->result_array();

      $this->load->view('admin/header', $data);
      $this->load->view('admin/' . $content, $data);
      $this->load->view('admin/footer', $data);
    } else {
      # code...
      redirect('home');
    }
  }

  public function index()
  {
    $this->menu('v_profil', 'Data Pengguna');
  }

  public function sekolah()
  {
    $this->menu('v_sekolahProfil', 'Data Sekolah');
  }

  public function edit()
  {
    $id = $_POST['id_user'];
    $data = array(
      'nis'  => trim(htmlspecialchars($_POST['nis'])),
      'nama'  => trim(htmlspecialchars($_POST['nama'])),
      'pwd'  => trim(htmlspecialchars($_POST['pwd'])),
      'password'  => trim(htmlspecialchars(str_replace('-','',$_POST['pwd']))),
      'hp'  => trim(htmlspecialchars($_POST['hp'])),
      'pj'  => trim(htmlspecialchars($_POST['pj'])),
      'alamat'  => trim(htmlspecialchars($_POST['alamat'])),
      'level'  => trim(htmlspecialchars($_POST['level'])),
    );

    if($data){
      $this->db->where('id_user', $id);
      $this->db->update('tb_user', $data);
  
      $msg = array(
        'sukses' => ' Data Pengeluaran berhasil tersimpan'
      );
    }

    echo json_encode($msg);
  }

  public function ubaFoto()
  {
    $data = array(
      'judul' => $judul,
      'date' => date('Y-m-d'),
      'isi'    => $isi,
      'slug'    => $slug,
    );

    $config['upload_path']          = './asset/img/post/';
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 1024; // 1MB
    // $config['max_width']            = 1024;
    // $config['max_height']           = 768;

    $this->load->library('upload', $config);

    if ($this->form_validation->run() == TRUE) {
      if (!$this->upload->do_upload('img')) {
        echo $this->upload->display_errors();
      } else {
        $img = $this->upload->data('file_name');
        $this->db->set('img', $img);
      }
      $this->db->insert('tb_post', $data);
      $this->session->set_flashdata('alert', '<div class="alert alert-info">Data baru berhasiil ditambahkan</div>');
      redirect('post');
    } else {
      $this->session->set_flashdata('alert', '<div class="alert alert-danger">Mohon maaf. data gagal ditambahkanh</div>');
      redirect('post');
    }
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
