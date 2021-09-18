<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Rabps extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Model_global', 'M_global');
    $this->load->helper('tgl_indo');
    $this->load->helper('rupiah');
  }

  public function core($data)
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
      $this->db->order_by('id_paket', 'DESC');
      $data['produk'] = $this->db->get('paket')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();

      $query = 'SELECT ta FROM tb_rab_kertas GROUP BY ta';
      $data['thn_ajaran'] = $this->db->query($query)->result();
      // var_dump($data['thn_ajaran']);
      // die;

      $this->load->view('admin/header', $data);
      $this->load->view('rabps/' . $data['page'], $data);
      $this->load->view('admin/footer', $data);
    } else {
      # code...
      redirect('home/login_page');
    }
  }

  public function index()
  {
    $data = array(
      'page' => 'v_rabps',
      'title' => 'RABPS',
      'parent'  => 'Laporan'
    );
    $this->core($data);
  }

  public function rencana()
  {
    $query = 'SELECT ta FROM tb_rab_kertas GROUP BY ta';
    $rab = $this->db->query($query)->result();

    $data = array(
      'page' => 'v_kertas',
      'title' => 'Kertas Kerja RABPS',
      'parent' => 'Input',
      'rab'   => $rab
    );
    // $this->db->where('is_active', 1);
    // var_dump($data['rab']->result());
    $this->core($data);
  }

  public function adds()
  {
    $data = array(
      'page' => 'v_add',
      'title' => 'Input Kertas Kerja RABPS',
      'parent'  => 'Input',
      'ta'    => '2016-2017'
    );
    $this->core($data);
  }

  public function tambah($ta = '')
  {

    // $data['ta'] = $this->uri->segment(3);
    if ($ta != '') {
      $data = array(
        'page' => 'v_update',
        'title' => 'Update Kertas Kerja RABPS tahun ' . $ta,
        'parent' => 'Input',
        'id_page'   => 'update',
        'ta' => $ta
      );
    } else {
      $data = array(
        'page' => 'v_tambah',
        'title' => 'Input Kertas Kerja RABPS',
        'parent' => 'Input',
        'id_page'   => 'tambah',
        'ta' => ''
      );
    }
    $this->db->where('kategori', 1);
    // $this->db->where('parent', 0);
    $data['pemasukan'] = $this->db->get('tb_rab')->result();

    $this->db->where('kategori', 2);
    // $this->db->where('parent', 0);
    $data['pengeluaran'] = $this->db->get('tb_rab')->result();
    $data['rab'] = $this->db->get('tb_rab')->result();

    $this->core($data);
  }

  public function detailRencana($id)
  {
    $data = array(
      'page' => 'v_detail',
      'title' => 'Detail Kertas Kerja ' . $id,
      'parent' => 'RABPS'
    );
    $this->db->where('kategori', 1);
    $this->db->where('parent', 0);
    $data['pemasukan'] = $this->db->get('tb_rab')->result();
    $this->db->where('kategori', 2);
    $this->db->where('parent', 0);
    $data['pengeluaran'] = $this->db->get('tb_rab')->result();
    $data['ta'] = $id;
    $this->core($data);
  }

  public function addSiswa()
  {

    $this->form_validation->set_rules('nama', 'Nama Produk', 'trim|required');
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

  public function add()
  {
    $kode_akun = $this->input->post('kode_akun');
    $ta = $this->input->post('ta');

    $this->db->where('ta', $ta);
    $this->db->where('kode_akun', $kode_akun);
    $rab = $this->db->get('tb_rab_kertas')->row();

    if ($rab) {
      $data = [
        'ta'            => $this->input->post('ta'),
        'kode_akun'     => $this->input->post('kode_akun'),
        'kategori'      => $this->input->post('kategori'),
        'parent'        => $this->input->post('parent'),
        'tgl_input'        => $this->input->post('tgl_input'),
        'jml_siswa'     => $this->input->post('jml_siswa'),
        'qty'           => $this->input->post('qty'),
        'hrg_satuan'    => $this->input->post('hrg_satuan'),
        'jumlah'        => $this->input->post('jumlah'),
        'is_active'     => 1
      ];

      $this->db->where('ta', $ta);
      $this->db->where('kode_akun', $kode_akun);
      $this->db->update('tb_rab_kertas', $data);

      $this->db->where('kode_akun', $kode_akun);
      $akun = $this->db->get('tb_rab')->row();
      $hasil = 'Data "' . $akun->nama . '" berhasil dirubah';
    } else {

      $data = [
        'ta'            => $this->input->post('ta'),
        'kode_akun'     => $this->input->post('kode_akun'),
        'created_at'    => date('Y-m-d'),
        'kategori'      => $this->input->post('kategori'),
        'parent'        => $this->input->post('parent'),
        'tgl_input'        => $this->input->post('tgl_input'),
        'jml_siswa'     => $this->input->post('jml_siswa'),
        'qty'           => $this->input->post('qty'),
        'hrg_satuan'    => $this->input->post('hrg_satuan'),
        'jumlah'        => $this->input->post('jumlah'),
        'is_active'     => 1
      ];

      $this->db->insert('tb_rab_kertas', $data);

      $this->db->where('kode_akun', $kode_akun);
      $akun = $this->db->get('tb_rab')->row();
      $hasil = 'Data "' . $akun->nama . '" berhasil ditambahkan';
    }
    $aff = $this->db->affected_rows();

    if ($aff > 0) {
      $result = ['sukses' => $hasil];
    } else {
      $result = ['error' => 'Data gagal ditambahkan/dirubah'];
    }

    echo json_encode($result);
  }

  public function getAll($table)
  {
    $result = $this->M_global->getBy($table);

    $no = 1;
    $hasil = array();
    foreach ($result as $key) {
      $hasil[] =  array(
        'no'  => $no++,
        'date' => $key->date_created,
        'id_user' => $key->id_user,
        'tgl' => $key->date_created,
        'nama' => $key->nama,
        'kelas' => $key->kelas,
        'spp' => rupiah($key->spp)
      );
    }
    echo json_encode($hasil);
  }

  public function detail()
  {
    $id = $_POST['id'];
    $result = $this->M_global->get_by_id($id, 'tb_user');
    echo json_encode($result);
  }

  public function pemasukan($id = 13)
  {
    $this->db->where('id_ajaran', $id);
    $ta = $this->db->get('tb_ta')->row();
    if ($ta != null) {
      $this->db->where('kategori', 1);
      $this->db->where('parent', 0);
      $this->db->where('ta', $ta->ta);
      $data = $this->db->get('tb_rab')->result();
      $no = 1;
      $result = array();
      foreach ($data as $da) {
        $this->db->where('parent', $da->id);
        $this->db->where('kategori', 1);
        $this->db->where('ta', $ta->ta);
        $lebih = $this->db->get('tb_rab')->result();
        $detail = array();
        $n = 1;
        if ($lebih != null) {
          foreach ($lebih as $l) {

            $this->db->select_sum('jumlah', 'total');
            $this->db->where('byr_utk', $l->kode_akun);
            $this->db->where('acc', 1);
            $akt = $this->db->get('tb_pembayaran')->row();

            $detail[] = array(
              'n' => $n++,
              'id' => $l->id,
              'nama' => $l->nama,
              'jml_siswa'  => ($l->jml_siswa == null) ? '' : $l->jml_siswa,
              'qty'  => ($l->qty == null) ? '' : $l->qty,
              'hrg_satuan'  => rupiah($l->hrg_satuan),
              'jumlah'  => rupiah($l->jumlah),
              'aktual' => ($akt->total != null) ? rupiah($akt->total) : 0
            );
          }
        }

        $this->db->select_sum('jumlah', 'total');
        $this->db->where('byr_utk', $da->kode_akun);
        $this->db->where('acc', 1);
        $aktual = $this->db->get('tb_pembayaran')->row();
        // var_dump($detail);die;
        $this->db->select_sum('jumlah', 'total');
        $this->db->where('parent', $da->id);
        $isi = $this->db->get('tb_rab')->row();

        $this->db->select_sum('jumlah', 'grandtotal');
        $this->db->where('ta', $ta->ta);
        $total = $this->db->get('tb_rab')->row();

        $result[] = array(
          'no' => $no++,
          'total' => $total->grandtotal,
          'id' => $da->id,
          'nama' => $da->nama,
          'jml_siswa'  => $da->jml_siswa,
          'qty'  => $da->qty,
          'hrg_satuan'  => $da->hrg_satuan,
          'jumlah'  => rupiah($isi->total),
          'aktual' => ($aktual->total != null) ? rupiah($aktual->total) : 0,
          'detail' => $detail
        );
      }
      echo json_encode($result);
    }
  }

  public function total($i = 1, $id = 13)
  {
    // $id = $_POST['id'];
    // $id = '13';
    $this->db->where('id_ajaran', $id);
    $ta = $this->db->get('tb_ta')->row_array();

    $this->db->where('ta', $ta['ta']);
    $this->db->where('acc', 1);
    $this->db->where('kategori', $i);
    $this->db->select_sum('jumlah', 'total');
    $aktual = $this->db->get('tb_pembayaran')->row();

    $this->db->where('ta', $ta['ta']);
    $this->db->where('kategori', $i);
    $this->db->select_sum('jumlah', 'total');
    $total = $this->db->get('tb_rab')->row();

    $data = array(
      'total' => rupiah($total->total),
      'masuk' => rupiah($aktual->total)
    );

    echo json_encode($data);
  }

  public function pengeluaran($id = 15)
  {
    $this->db->where('id_ajaran', $id);
    $ta = $this->db->get('tb_ta')->row();
    if ($ta != null) {
      $this->db->where('kategori', 2);
      $this->db->where('parent', 0);
      $this->db->where('ta', $ta->ta);
      $data = $this->db->get('tb_rab')->result();
      $no = 1;
      $result = array();
      foreach ($data as $da) {

        $this->db->select_sum('jumlah', 'total');
        $this->db->where('byr_utk', $da->kode_akun);
        $aktual = $this->db->get('tb_pembayaran')->row();

        $this->db->where('parent', $da->id);
        $this->db->where('kategori', 2);
        $this->db->where('ta', $ta->ta);
        $lebih = $this->db->get('tb_rab')->result();

        $detail = array();
        $n = 1;
        if ($lebih != null) {
          foreach ($lebih as $l) {
            $this->db->select_sum('jumlah', 'total');
            $this->db->where('byr_utk', $l->kode_akun);
            $this->db->where('acc', 1);
            $akt = $this->db->get('tb_pembayaran')->row();
            $detail[] = array(
              'n' => $n++,
              'id' => $l->id,
              'nama' => $l->nama,
              'jml_siswa'  => ($l->jml_siswa == null) ? '' : $l->jml_siswa,
              'qty'  => ($l->qty == null) ? '' : $l->qty,
              'hrg_satuan'  => rupiah($l->hrg_satuan),
              'jumlah'  => rupiah($l->jumlah),
              'aktual' => ($akt->total != null) ? rupiah($akt->total) : 0
            );
          }
        }
        // var_dump($detail);die;
        $this->db->select_sum('jumlah', 'total');
        $this->db->where('parent', $da->id);
        $isi = $this->db->get('tb_rab')->row();

        $this->db->select_sum('jumlah', 'grandtotal');
        $this->db->where('ta', $ta->ta);
        $total = $this->db->get('tb_rab')->row();
        $result[] = array(
          'no' => $no++,
          'total' => $total->grandtotal,
          'id' => $da->id,
          'nama' => $da->nama,
          'jml_siswa'  => $da->jml_siswa,
          'qty'  => $da->qty,
          'hrg_satuan'  => '',
          'jumlah'  => rupiah($isi->total),
          'aktual' => ($aktual->total != null) ? rupiah($aktual->total) : 0,
          'detail' => $detail
        );
      }
      echo json_encode($result);
    }
  }

  public function hapusRab($id)
  {
    $this->db->where('ta', $id);
    $this->db->delete('tb_rab_kertas');
    if ($this->db->affected_rows() > 0) {
      $this->session->set_flashdata('alert', '<div class="alert alert-info">Data RABPS tahun ' . $id . ' berhasil terhapus</div>');
      redirect('rabps/rencana');
    } else {
      $this->session->set_flashdata('alert', '<div class="alert alert-danger">Mohon maaf. data RABPS tahun ' . $id . ' gagal terhapus</div>');
      redirect('rabps/rencana');
    }
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
