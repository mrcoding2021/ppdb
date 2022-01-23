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

  public function closingGlobal()
  {
    $data = array(
      'title'   => 'Laporan Closing Global',
      'view'    => 'closingGlobal',
      'parent'  => 'Laporan'
    );
    $this->index($data);
  }

  public function getBukuKas($kas = '0-10000', $ta = '2020-2021', $bln = 0, $thn = '2021')
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
          'keterangan'  => '',
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

  public function getGlobal($ta)
  {
    $this->db->where('level', 4);
    $this->db->where('is_active', 1);
    $siswa = $this->db->get('tb_user')->result();

    $result = [];
    $no = 1;
    $tagihan = [];
    $bayar = [];

    for ($x = 0; $x < count($siswa); $x++) {
      // $id_user = 2198;
      $id_user =  $siswa[$x]->id_user;
      $kode = ['PEMBANGUNAN', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU PAKET', 'SPP',  'SARPRAS'];
      for ($i = 0; $i < 7; $i++) {
        $this->db->where('kode', $kode[$i]);
        $this->db->where('id_murid', $id_user);
        $this->db->where('ta', $ta);
        $tag = $this->db->get('tb_user_tagihan')->row();

        if ($tag == null) {
          $tagihan[] = (object)['bayar' => 0];
        } else {
          $tagihan[] = [
            'bayar'   => $tag->bayar
          ];
        }
        $tag = null;
        $this->db->where('kode', $kode[$i]);
        $this->db->where('id_murid', $id_user);
        $this->db->where('ta', $ta);
        $this->db->select_sum('jumlah', 'total');
        $bay = $this->db->get('tb_transaksi')->row();

        if ($bay == null) {
          $bayar[] = (object)['total' => 0];
        } else {
          $bayar[] = $bay;
        }
        $bay = null;
      }
      $i = 0;
      $result[] = [
        'no'            => $no,
        'nama'          => $siswa[$x]->nama,

        'tagihan_p'     => rupiah($tagihan[0]->bayar),
        'bayar_p'       => rupiah($bayar[0]->total),
        'sisa_p'        => rupiah($tagihan[0]->bayar - $bayar[0]->total),

        'tagihan_k'     => rupiah($tagihan[1]->bayar),
        'bayar_k'       => rupiah($bayar[1]->total),
        'sisa_k'        => rupiah($tagihan[1]->bayar - $bayar[1]->total),

        'tagihan_s'     => rupiah($tagihan[2]->bayar),
        'bayar_s'       => rupiah($bayar[2]->total),
        'sisa_s'        => rupiah($tagihan[2]->bayar - $bayar[2]->total),

        'tagihan_kom'   => rupiah($tagihan[3]->bayar),
        'bayar_kom'     => rupiah($bayar[3]->total),
        'sisa_kom'      => rupiah($tagihan[3]->bayar - $bayar[3]->total),

        'tagihan_b'     => rupiah($tagihan[4]->bayar),
        'bayar_b'       => rupiah($bayar[4]->total),
        'sisa_b'        => rupiah($tagihan[4]->bayar - $bayar[4]->total),

        'tagihan_spp'   => rupiah($tagihan[5]->bayar),
        'bayar_spp'     => rupiah($bayar[5]->total),
        'sisa_spp'      => rupiah($tagihan[5]->bayar - $bayar[5]->total),

        'tagihan_sar'   => rupiah($tagihan[6]->bayar),
        'bayar_sar'     => rupiah($bayar[6]->total),
        'sisa_sar'      => rupiah($tagihan[6]->bayar - $bayar[6]->total),
      ];
      $no++;
    }
    echo json_encode($result);
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
