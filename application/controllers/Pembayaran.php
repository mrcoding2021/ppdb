<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pembayaran extends CI_Controller
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
      $data['title'] = 'Pembayaran Siswa';
      $data['parent'] = 'Input';
      $data['admin'] = $this->db->query($query)->result_array();
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['pembayaran'] = $this->db->get('tb_pembayaran')->result();
      $this->load->view('admin/header', $data);
      $this->load->view('admin/pembayaran/v_pembayaran', $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('home/');
    }
  }

  public function cari()
  {
    $nama = $_GET['nama'];
    // $nama = 'faris';
    // $ta = '2020-2021';
    $result = $this->Model_global->cari('tb_user', $nama);
    $data = array();
    foreach ($result as $key) {
      $ta = $_GET['ta'];
      $this->db->where('ta', $ta);
      $this->db->where('kode_kelas', $key->kelas);
      $kelas = $this->db->get('tb_user_kelas')->row();
      $data[] = array(
        'id' => $key->id_user,
        'hp' => $key->hp,
        'nama' => $key->nama,
        'kelas' => $kelas->ket . ' - ' . $kelas->nama,
        'nis' => $key->nis,
        'wali' => $key->pj,
        'kategori' => $key->kategori_murid,
        'spp'   => $kelas->spp,
        'gedung'   => $kelas->gedung,
        'kegiatan'   => $kelas->kegiatan,
        'seragam'   => $kelas->seragam,
        'buku'   => $kelas->buku,
        'komite'   => $kelas->komite,
        'sarpras'   => ($kelas->sarpras == null) ? 0 : $kelas->sarpras,
        'total'   => $kelas->spp + $kelas->gedung + $kelas->kegiatan + $kelas->seragam + $kelas->buku + $kelas->komite + $kelas->sarpras
      );
    }
    echo json_encode($data);
  }

  public function cariX()
  {
    $nama = $_GET['nama'];
    $result = $this->Model_global->cari('tb_user', $nama);
    $data = array();
    foreach ($result as $key) {
      $data[] = array(
        'id' => $key->id_user,
        'hp' => $key->hp,
        'nama' => $key->nama,
        'nis' => $key->nis,
        'wali' => $key->pj,
        'spp' => $key->spp,
        'kategori' => $key->kategori_murid
      );
    }
    echo json_encode($data);
  }

  public function inputData()
  {

    $inv = $_POST['sumber'];
    $count = count($inv);
    if ($_POST['id_user']) {
      for ($i = 0; $i < $count; $i++) {

        if ($_POST['sumber'][$i] == 4) {
          $jumlah = '-' . $_POST['total'][$i];
        } else {
          $jumlah = $_POST['total'][$i];
        }

        $this->db->where('id', $_POST['kategori'][$i]);
        $akun = $this->db->get('tb_rab')->row();

        $data = array(
          'no_invoice'  => trim($_POST['no_invoice']),
          'created_at' => date('Y-m-d'),
          'id_murid'  => $_POST['id_user'],
          'byr_utk'   => $_POST['kategori'][$i],
          'id_sumber' => $_POST['sumber'][$i],
          'i_o'       => $akun->alias,
          'dari_kas'  => 'Siswa',
          'ket'       => $_POST['ket'][$i],
          'kredit'    => $_POST['kredit'][$i],
          'diskon'    => $_POST['diskon'][$i],
          'jumlah'    => $jumlah,
          'ta'        => $_POST['ta']
        );
        // var_dump($data);
        $this->db->insert('tb_pembayaran', $data);

        if ($this->db->affected_rows() > 0) {
          $msg = array(
            'sukses' => ' Data Pembayaran berhasil tersimpan'
          );
        } else {
          $msg = array(
            'error' => ' Data Pembayaran gagal tersimpan'
          );
        }
      }
    } else {
      $msg = array(
        'error' => ' Data Pembayaran gagal tersimpan'
      );
    }
    echo json_encode($msg);
  }

  public function find($id)
  {
    $result = $this->Model_global->get_by_id($id, 'tb_user');
    echo json_encode($result);
  }

  public function siswa()
  {
    $trx = $this->input->post('akun_trx');
    $kode = ['SPP', 'INFAQ GEDUNG', 'SERAGAM', 'KEGIATAN', 'BUKU', 'KOMITE', 'SARPRAS'];
    for ($i = 0; $i < count($trx); $i++) {
      $data = [
        'date_created' => $this->session->userdata('tgl_byr'),
        'inputer'   => $this->session->userdata('id'),
        'id_trx'       => str_replace(' ', '', $this->input->post('inv')),
        'ta'           => $this->input->post('ta'),
        'id_murid'     => $this->input->post('id_murid'),
        'bayar'        => $this->input->post('bayar')[$i],
        'kode'         => $kode[$i],
        'akun_kas'     => '0-10001',
        'akun_trx'     => $this->input->post('akun_trx')[$i],
        'diskon'       => $this->input->post('diskon')[$i],
        'jumlah'        => $this->input->post('jml')[$i],
        'ket'          => $this->input->post('ket')[$i],
        'approve'      => 0
      ];
      $this->db->insert('tb_transaksi', $data);
    }
    if ($this->db->affected_rows() > 0) {
      $msg = array(
        'sukses' => 'Data Pembayaran berhasil tersimpan'
      );
    } else {
      $msg = array(
        'error' => 'Data Pembayaran gagal tersimpan'
      );
    }
    echo json_encode($msg);
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
