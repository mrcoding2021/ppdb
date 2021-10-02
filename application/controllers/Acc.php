<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Acc extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('tgl_indo');
    $this->load->model('database');
    $this->load->helper('rupiah');
    $this->load->helper('terbilang');
  }

  public function core($data)
  {
    $id = $this->session->userdata('id');
    if ($id) {
      $id = $this->session->userdata('id_user');
      $level = $this->session->userdata('level');
      $table = 'tb_user';
      $query = "SELECT `id_user`, `menu`
          FROM `tb_user_menu` JOIN `tb_menu_acces` 
            ON `tb_user_menu`.`id_user` = `tb_menu_acces`.`menu_id`
          WHERE `tb_menu_acces`.`role_id`= $level
        ORDER BY `tb_menu_acces`.`menu_id` ASC";
      $data['admin'] = $this->db->query($query)->result_array();
      $this->db->where_not_in('level', 3);
      $data['userfull'] = $this->db->get('tb_user')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $this->load->view('admin/header', $data);
      $this->load->view('acc/' . $data['page'], $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('auth');
    }
  }

  public function index()
  {
    $this->db->where('is_active', 1);
    $this->db->where('kategori', 0);
    $kas = $this->db->get('tb_rab')->result();
    $query = 'SELECT * FROM tb_rab WHERE is_parent = 1';
    $akun = $this->db->query($query)->result();
    $metode = $this->db->get('tb_metode')->result();
    $data = [
      'title'   => 'Transaksi Pengajuan',
      'page'    => 'index',
      'parent'  => 'Acc',
      'kas'     => $kas,
      'akun'    => $akun,
      'metode'  => $metode
    ];
    $this->core($data);
  }

  public function getAcc($bln = '', $thn = '', $kode = 0)
  {
    if ($this->scm->cekSecurity() == true) {
      if ($bln != '' && $thn != '') {
        $this->db->where('month(date_created)', $bln);
        $this->db->where('year(date_created)', $thn);
      }
      $this->db->select('id_trx', 'date_created', 'id_murid');
      $this->db->group_by('tb_transaksi.id_trx');
      if ($kode == 0) {
        $this->db->where('approve', 0);
      } else {
        $this->db->where('approve', 1);
      }
      $data = $this->db->get('tb_transaksi')->result();

      $result = [];
      $no = 1;
      foreach ($data as $key) {

        $this->db->select_sum('jumlah', 'total');
        $this->db->where('id_trx', $key->id_trx);
        $jumlah = $this->db->get('tb_transaksi')->row();

        $this->db->where('id_trx', $key->id_trx);
        $kategori = $this->db->get('tb_transaksi')->row();

        $this->db->where('id_trx', $key->id_trx);
        $trx = $this->db->get('tb_transaksi')->row();

        $this->db->where('id_user', $trx->id_murid);
        $siswa = $this->db->get('tb_user')->row();

        $result[] = [
          'no'      => $no,
          'tgl'     => $trx->date_created,
          'id'     => $trx->id,
          'inv'     => $trx->id_trx,
          'siswa'   => ($siswa != null) ? $siswa->nama : 'KAS',
          'jumlah'  => rupiah($jumlah->total),
          'kategori' => ($kategori->kategori == 1) ? 'Pemasukan' : 'Pengeluaran'
        ];
        $no++;
      }
      echo json_encode($result);
    }
  }

  public function user($id)
  {
    if ($this->scm->cekSecurity() == true) {
      $data = $this->database->user($id);
      echo json_encode($data);
    }
  }

  public function accept()
  {
    $inv = $this->input->post('inv');
    if ($this->scm->cekSecurity() == true) {
      $this->db->set('approve', 1);
      $this->db->where('id_trx', $inv);
      $this->db->update('tb_transaksi');
      if ($this->db->affected_rows() > 0) {
        $result = ['success' => "Transaksi berhasil masuk ke pembukuan"];
      } else {
        $result = ['error' => "Transaksi gagal"];
      }
      echo json_encode($result);
    }
  }

  public function getMore()
  {
    if ($this->scm->cekSecurity() == true) {
      $id_trx = $this->input->post('inv');
      $this->db->where('id_trx', $id_trx);
      $data = $this->db->get('tb_transaksi')->result();
      $result = [];
      $this->db->where('id_trx', $id_trx);
      $this->db->select_sum('jumlah', 'total');
      $total = $this->db->get('tb_transaksi')->row();
      foreach ($data as $key) {
        $this->db->where('kode_akun', $key->akun_trx);
        $akun = $this->db->get('tb_rab')->row();
        $result[] = [
          'tagihan'      => rupiah($key->tagihan),
          'jns'    => $key->kode,
          'akun'  => $akun->nama,
          'bayar'     => rupiah($key->kredit),
          'diskon'  => rupiah($key->diskon),
          'jml'   => rupiah($key->jumlah),
          'total' => rupiah($total->total),
          'terbilang' => to_word($total->total)
        ];
      }
      echo json_encode($result);
    }
  }

  public function getInv()
  {
    if ($this->scm->cekSecurity() == true) {
      $id_trx = $this->input->post('inv');
      $this->db->where('id', $id_trx);
      $data = $this->db->get('tb_transaksi')->row();
      $result = [
        'date'  => substr($data->date_created, 0, 10),
        'jumlah'  => rupiah($data->jumlah),
        'ket'   => $data->ket,
        'akun_trx'   => $data->akun_trx,
        'akun_kas'   => $data->akun_kas,
        'nama'   => $data->nama,
        'metode'   => $data->metode,
        'id'    => $data->id,
        'ta'    => $data->ta,
        'id_trx'    => $data->id_trx,
        'id_murid'    => $data->id_murid,
        'kategori'    => $data->kategori,
      ];
      echo json_encode($result);
    }
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
