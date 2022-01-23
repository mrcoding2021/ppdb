<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Sispem extends CI_Controller
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
      $data['parent'] = 'Laporan';
      $data['admin'] = $this->db->query($query)->result_array();
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $this->db->order_by('id_paket', 'DESC');
      $data['produk'] = $this->db->get('paket')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['slider'] = $this->db->get('tb_slider')->result_array();

      $this->load->view('admin/header', $data);
      $this->load->view($content, $data);
      $this->load->view('admin/footer', $data);
    } else {
      # code...
      redirect('home');
    }
  }

  public function index()
  {
    $this->menu('v_data', 'Data Siswa');
  }

  public function addSiswa()
  {

    $this->form_validation->set_rules('nama', 'Nama   Produk', 'trim|required');
    $judul = htmlspecialchars($this->input->post('nama'));

    $data = array(
      'nis' => htmlspecialchars($_POST['nis']),
      'nama' => htmlspecialchars($_POST['nama']),
      'kelas' => htmlspecialchars($_POST['kelas']),
      'alamat' => htmlspecialchars($_POST['alamat']),
      'hp' => htmlspecialchars($_POST['hp']),
      'spp' => htmlspecialchars($_POST['spp']),
      'parent' => htmlspecialchars($_POST['id']),
      'pj' => htmlspecialchars($_POST['wali']),
    );

    if ($this->form_validation->run() == TRUE) {
      $this->db->insert('tb_user', $data);
      echo 'sukses';
    } else {
      echo 'gagal';
    }
  }

  public function delete($id)
  {

    $this->M_global->delete('tb_user', $id);
  }

  public function getAll()
  {
    $this->db->where('level', 4);
    $this->db->where('is_active', 1);
    
    $result = $this->db->get('tb_user')->result();

    $no = 1;
    $hasil = array();
    foreach ($result as $key) {
      if (date('m') > 6) {
        $this->db->where('ta', date('Y') . '-' . (date('Y') + 1));
      } elseif (date('m') < 7) {
        $this->db->where('ta', (date('Y') - 1) . '-' . date('Y'));
      }
      $this->db->where('id_murid', $key->id_user);
      $ajaran = $this->db->get('tb_user_tagihan')->result();
      
      if ($ajaran) {
        $this->db->where('kode_kelas', $ajaran[0]->kelas);
        $kelas = $this->db->get('tb_user_kelas')->row();
      } else {
        $kelas = '';
      }

      $hasil[] =  array(
        'no'  => $no,
        'nis' => $key->nis,
        'nisn' => $key->nisn,
        'id_user' => $key->id_user,
        'tgl' => $key->date_created,
        'nama' => $key->nama .' - '. $key->id_user,
        'kelas' => ($kelas) ? $kelas->nama : $kelas,
        'spp' => rupiah($key->spp)
      );
      $no++;
    }
    echo json_encode($hasil);
  }

  public function detail()
  {
    $id = $_POST['id'];
    $result = $this->M_global->get_by_id($id, 'tb_user');
    echo json_encode($result);
  }

  public function pemasukanHarian()
  {

    $this->menu('laporan/pemasukanHarian', 'Pemasukan Harian');
  }

  public function pengeluaranHarian()
  {

    $this->menu('laporan/pengeluaranHarian', 'Pengeluaran Harian');
  }

  public function siswa()
  {
    // $this->menu('laporan/pembayaranSiswa', 'Laporan Pembayaran Siswa');
    $this->menu('pembayaran/report', 'Laporan Pembayaran Siswa');
  }

  public function tunggakan()
  {
    $this->menu('pembayaran/v_tunggakanSiswa', 'Tunggakan Siswa');
  }

  public function get_All($id = 0)
  {
    if ($id > 0) {
      $this->db->where('id_pembayaran', $id);
      $data = $this->db->get('tb_pembayaran')->row();
      $result = array(
        'created_at'  => $data->created_at,
        'spp'  => rupiah($data->spp),
        'infaq_gedung'  => rupiah($data->infaq_gedung),
        'kegiatan'  => rupiah($data->kegiatan),
        'seragam'  => rupiah($data->seragam),
        'komite'  => rupiah($data->komite),
        'buku'  => rupiah($data->buku),
        'ekskul'  => rupiah($data->ekskul),
      );
    } else {
      $this->db->group_by('created_at');
      $this->db->select('created_at');
      $data = $this->db->get('tb_pembayaran')->result();
      $no = 1;
      $result = array();
      foreach ($data as $da) {
        $this->db->select_sum('kredit', 'spp');
        $this->db->where(array('byr_utk' => 1, 'created_at' => $da->created_at));
        $spp = $this->db->get('tb_pembayaran')->row();
        $this->db->select_sum('kredit', 'spp');
        $this->db->where(array('byr_utk' => 2, 'created_at' => $da->created_at));
        $idung = $this->db->get('tb_pembayaran')->row();
        $this->db->select_sum('kredit', 'spp');
        $this->db->where(array('byr_utk' => 3, 'created_at' => $da->created_at));
        $keg = $this->db->get('tb_pembayaran')->row();
        $this->db->select_sum('kredit', 'spp');
        $this->db->where(array('byr_utk' => 4, 'created_at' => $da->created_at));
        $segam = $this->db->get('tb_pembayaran')->row();
        $this->db->select_sum('kredit', 'spp');
        $this->db->where(array('byr_utk' => 5, 'created_at' => $da->created_at));
        $kom = $this->db->get('tb_pembayaran')->row();
        $this->db->select_sum('kredit', 'spp');
        $this->db->where(array('byr_utk' => 6, 'created_at' => $da->created_at));
        $buku = $this->db->get('tb_pembayaran')->row();
        $this->db->select_sum('kredit', 'spp');
        $this->db->where(array('byr_utk' => 7, 'created_at' => $da->created_at));
        $ekskul = $this->db->get('tb_pembayaran')->row();

        $total = $spp->spp + $idung->spp + $keg->spp + $kom->spp + $buku->spp + $ekskul->spp;
        $result[] = array(
          'no' => $no++,
          'created_at' => longdate_indo($da->created_at),
          'spp'  => rupiah($spp->spp),
          'infaq_gedung'  => rupiah($idung->spp),
          'kegiatan'  => rupiah($keg->spp),
          'seragam'  => rupiah($segam->spp),
          'komite'  => rupiah($kom->spp),
          'buku'  => rupiah($buku->spp),
          'ekskul'  => rupiah($ekskul->spp),
          'total'   => rupiah($total)
        );
      }
      echo json_encode($result);
    }
  }

  public function add()
  {
    $data = array(
      'tahun_ajaran'  => trim(htmlspecialchars($_POST['tahun_ajaran'])),
      'spp'  => trim(htmlspecialchars($_POST['spp'])),
      'infaq_gedung'  => trim(htmlspecialchars($_POST['infaq_gedung'])),
      'kegiatan'  => trim(htmlspecialchars($_POST['kegiatan'])),
      'seragam'  => trim(htmlspecialchars($_POST['seragam'])),
      'komite'  => trim(htmlspecialchars($_POST['komite'])),
      'buku'  => trim(htmlspecialchars($_POST['buku'])),
      'ekskul'  => trim(htmlspecialchars($_POST['ekskul'])),
    );

    if ($data) {
      $this->db->insert('tb_ta', $data);

      $msg = array(
        'sukses' => 'Data Berhasil tersimpan'
      );
    } else {
      $msg = array(
        'sukses' => 'Tidak ada data, silahkan input dengan benar dan lengkap'
      );
    }

    echo json_encode($msg);
  }

}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
