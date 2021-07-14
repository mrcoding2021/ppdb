<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Tunggakan extends CI_Controller
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
      $data['title'] = 'Pemasukan';
      $data['admin'] = $this->db->query($query)->result_array();
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $data['post'] = $this->db->get('tb_post')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['pembayaran'] = $this->db->get('tb_pembayaran')->result();
      $this->load->view('admin/header', $data);
      $this->load->view('admin/pemasukan/index', $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('home/');
    }
  }

  public function lunas()
  {
    $nama = $_POST['id'];
    $this->db->like('id_user', $nama);
    $this->db->or_like('nama', $nama);
    $user = $this->db->get('tb_user')->row();

    $this->db->where('kategori_murid', $user->kategori_murid);
    $ta = $this->db->get('tb_ta')->result();
    $no = 1;
    $data = array();
    foreach ($ta as $key) {

      // SPP 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'SPP');
      $this->db->select_sum('kredit', 'total');
      $spp = $this->db->get('tb_pembayaran')->row();

      // PEMBANGUNAN 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'UANG GEDUNG');
      $this->db->select_sum('kredit', 'total');
      $pembangunan = $this->db->get('tb_pembayaran')->row();

      // KEGIATAN 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'KEGAITAN');
      $this->db->select_sum('kredit', 'total');
      $kegiatan = $this->db->get('tb_pembayaran')->row();

      // SERAGAM 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'SERAGAM');
      $this->db->select_sum('kredit', 'total');   
      $seragam = $this->db->get('tb_pembayaran')->row();

      // KOMITE
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'KOMITE');
      $this->db->select_sum('kredit', 'total');
      $komite = $this->db->get('tb_pembayaran')->row();

      // BUKU 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'BUKU');
      $this->db->select_sum('kredit', 'total');
      $buku = $this->db->get('tb_pembayaran')->row();

      $data[] = array(
        'no' => $no++,
        'ta'  => $key->ta,
        'pembangunan' => rupiah($pembangunan->total),
        'kegiatan' => rupiah($kegiatan->total),
        'seragam' => rupiah($seragam->total),
        'komite'  => rupiah($komite->total),
        'buku_paket' => rupiah($buku->total),
        'spp' => rupiah($spp->total),
        'total'   => rupiah($pembangunan->total + $kegiatan->total + $seragam->total + $komite->total + $buku->total + $spp->total)
      );
    }

    echo json_encode($data);
  }

  public function hutang()
  {
    $nama = $_POST['id'];
    $this->db->like('id_user', $nama);
    $this->db->or_like('nama', $nama);
    $user = $this->db->get('tb_user')->row();

    $this->db->where('kategori_murid', $user->kategori_murid);
    $ta = $this->db->get('tb_ta')->result();
    $no = 1;
    $data = array();
    foreach ($ta as $key) {

      // SPP 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'SPP');
      $this->db->select_sum('kredit', 'total');
      $spp = $this->db->get('tb_pembayaran')->row();

      // PEMBANGUNAN 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'UANG GEDUNG');
      $this->db->select_sum('kredit', 'total');
      $pembangunan = $this->db->get('tb_pembayaran')->row();

      // KEGIATAN 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'KEGIATAN');
      $this->db->select_sum('kredit', 'total');
      $kegiatan = $this->db->get('tb_pembayaran')->row();

      // SERAGAM 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'SERAGAM');
      $this->db->select_sum('kredit', 'total');
      $seragam = $this->db->get('tb_pembayaran')->row();

      // KOMITE
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'KOMITE');
      $this->db->select_sum('kredit', 'total');
      $komite = $this->db->get('tb_pembayaran')->row();

      // BUKU 
      $this->db->where('ta', $key->ta);
      $this->db->where('id_murid', $user->id_user);
      $this->db->where('i_o', 'BUKU');
      $this->db->select_sum('kredit', 'total');
      $buku = $this->db->get('tb_pembayaran')->row();

      $a = $key->infaq_gedung - $pembangunan->total;
      if (!$pembangunan->total) {
        $a = 0;
      } else {
        $a = $a;
      }
      $b = $key->kegiatan - $kegiatan->total;
      if (!$kegiatan->total) {
        $b = 0;
      } else {
        $b = $b;
      }
      $c = $key->seragam - $seragam->total;
      if (!$seragam->total) {
        $c = 0;
      } else {
        $c = $c;
      }
      $d = $key->komite - $komite->total;
      if (!$komite->total) {
        $d = 0;
      } else {
        $d = $d;
      }
      $e = $key->buku - $buku->total;
      if (!$buku->total) {
        $e = 0;
      } else {
        $e = $e;
      }
      $f = ($user->spp * 7) - $spp->total;
      if (!$spp->total) {
        $f = 0;
      } else {
        $f = $f;
      }
      $g = $a + $b + $c + $d + $e + $f;

      $data[] = array(
        'no' => $no++,
        'ta'  => $key->ta,
        'pembangunan' => rupiah($a),
        'kegiatan' => rupiah($b),
        'seragam' => rupiah($c),
        'komite'  => rupiah($d),
        'buku_paket' => rupiah($e),
        'spp' => rupiah($f),
        'total'   => rupiah($g)
      );
    }

    echo json_encode($data);
  }
}


/* End of file Pemasukan.php */
/* Location: ./application/controllers/Pemasukan.php */
