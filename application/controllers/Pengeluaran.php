<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pengeluaran extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('tgl_indo');
    $this->load->helper('rupiah');
    $this->load->model('Model_global');
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
      $data['title'] = 'Pengeluaran';
      $data['admin'] = $this->db->query($query)->result_array();
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $data['post'] = $this->db->get('tb_post')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['rab'] = $this->db->get('tb_rab')->result();
      $this->load->view('admin/header', $data);
      $this->load->view('admin/pengeluaran/index', $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('home/');
    }
  }

  public function cari()
  {
    $nama = $_GET['nama'];
    $this->db->where_not_in('parent', 0);
    $this->db->where('kategori', 2);
    $this->db->like('nama', $nama);
    $this->db->or_like('id', $nama);
    $result = $this->db->get('tb_rab')->result();
    $data = array();
    foreach ($result as $key) {
      $this->db->where('id', $key->parent);
      $parent = $this->db->get('tb_rab')->row();
      
      $data[] = array(
        'id' => $key->id,
        'nama' => $key->nama,
        'parent' => $parent->nama,
        'kategori' => $key->kategori
      );
    }
    echo json_encode($data);
  }

  public function inputData()
  {
    $inv = $_POST['id'];
    $count = count($inv);
    if ($_POST['id']) {
      for ($i = 0; $i < $count; $i++) {
        $data = array(
          'no_invoice'  => trim($_POST['inv']),
          'created_at' => date('Y-m-d'),
          'inputer'   => $this->session->userdata('id'),
          'id_sumber'  => $_POST['metode'],
          'kategori'  => 1,
          'id_murid'  => 1,
          'byr_utk'  => $_POST['id'][$i],
          'i_o'   => $_POST['names'][$i],
          'ket'       => $_POST['kets'][$i],
          'dari_kas'  => $_POST['dari_kas'],
          'kredit'    => $_POST['nilai'][$i],
          'ta'        => $_POST['t_a']
        );
        $this->db->insert('tb_pembayaran', $data);
      }
      if ($this->db->affected_rows() > 0) {
        $msg = array(
          'sukses' => ' Data Pembayaran berhasil tersimpan'
        );
      } else {
        $msg = array(
          'error' => ' Data Pembayaran gagal tersimpan'
        );
      }
    } else {
      $msg = array(
        'sukses' => ' Data Pengeluaran berhasil tersimpan'
      );
    }

    echo json_encode($msg);
  }

  public function harian()
  {
    $this->db->group_by('created_at');
    $this->db->select();
    $date = $this->db->get('tb_pengeluaran')->result();

    $data = array();
    foreach ($date as $key) {
      $this->db->select_sum('kredit', 'total');
      $this->db->where('created_at', $key->created_at);
      $sum = $this->db->get('tb_pengeluaran')->row();
      $data[] = array(
        'created_at' => $key->created_at,
        'inv' => $key->no_invoice,
        'total' => rupiah($sum->total)
      );
    }
    echo json_encode($data);
  }

  public function delete()
  {
    $id = $this->uri->segment(3);
    $this->db->where('id_post', $id);
    $this->db->delete('tb_post');
    $this->session->set_flashdata('alert', '<div class="alert alert-info">Data berhasil dihapus</div>');
    redirect('post');
  }

  public function find($id)
  {
    $result = $this->Model_global->get_by_id($id, 'tb_user');
    echo json_encode($result);
  }
}


/* End of file Pemasukan.php */
/* Location: ./application/controllers/Pemasukan.php */
