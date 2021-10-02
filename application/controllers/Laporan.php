<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Laporan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('tgl_indo');
    $this->load->helper('rupiah');
  }

  public function index($data)
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
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $data['post'] = $this->db->get('tb_post')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['slider'] = $this->db->get('tb_slider')->result_array();
      $this->load->view('admin/header', $data);
      $this->load->view('laporan/' . $data['view'], $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('home/login_page');
    }
  }

  public function bukuKas()
  {
    $data = array(
      'title'   => 'Laporan Buku Kas',
      'view'    => 'bukuKas',
      'parent'  => 'Laporan'
    );
    $this->index($data);
  }

  public function keuangan()
  {
    $data = array(
      'title'   => 'Laporan Keuangan',
      'view'    => 'keuangan',
      'parent'  => 'Laporan'
    );
    $this->index($data);
  }

  public function getBukuKas($kas = '0-10000',$ta = '2020-2021', $bln = 0, $thn = '2021')
  {

    if ($bln != 0) {
      $this->db->where('month(date_created)', $bln);
    }
    $this->db->where('approve', 1);
    $this->db->where('akun_kas', $kas);
    $this->db->where('ta', $ta);
    $this->db->where('year(date_created)', $thn);
    $data = $this->db->get('tb_transaksi')->result();

    $this->db->where('ta', $ta);
    $this->db->where('month(date_created)', $bln);
    $this->db->where('year(date_created)', $thn);
    $this->db->select_sum('jumlah', 'total');
    $jumlah = $this->db->get('tb_transaksi')->row();
    // var_dump($data);die;
    $result = array();
    if ($data != null) {
      $sum = $jumlah->total;
      foreach ($data as $key) {
        $this->db->where('kode_akun', $key->akun_trx);
        $akun = $this->db->get('tb_rab')->row();

        if ($key->kredit == 0) {
          $sum = $sum - $key->debit;
        } else {
          $sum = $sum + $key->kredit - $key->debit;
        }

        $this->db->where('id', $akun->parent);
        $parent = $this->db->get('tb_rab')->row_array();
        // var_dump($parent->nama);die;
        $result[] = array(
          'created_at' => shortdate_indo(substr($key->date_created, 0, 10)),
          'kode_akun' => $key->akun_trx,
          'nama'      => '',
          'keterangan'  =>'',
          'debit'   => rupiah($key->jumlah),
          'kredit'  => rupiah($key->diskon),
          'saldo'   => rupiah($sum)
        );
      }
    } else {
      $result = [];
    }
    echo json_encode($result);
  }

  public function delete()
  {
    $id = $this->uri->segment(3);
    $this->db->where('id_post', $id);
    $this->db->delete('tb_post');
    $this->session->set_flashdata('alert', '<div class="alert alert-info">Data berhasil dihapus</div>');
    redirect('post');
  }

  public function pembayaranSiswa()
  {
    $data = array(
      'title'   => 'Laporan Pembayaran Siswa',
      'view'    => 'pembayaranSiswa',
      'parent'  => 'Laporan'
    );
    $this->index($data);
  }

  public function pemasukanHarian()
  {
    $data = array(
      'title'   => 'Laporan Pemasukan Harian',
      'view'    => 'pemasukanHarian',
      'parent'  => 'Laporan'
    );
    $this->index($data);
  }

  public function pengeluaranHarian()
  {
    $data = array(
      'title'   => 'Laporan Pengeluaran Harian',
      'view'    => 'pengeluaranHarian',
      'parent'  => 'Laporan'
    );
    $this->index($data);
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
