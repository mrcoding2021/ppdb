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
      $data['title'] = $data['title'];
      $data['parent'] = 'Input';
      $data['admin'] = $this->db->query($query)->result_array();
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $this->db->where('parent', 0);
      $this->db->where('kategori', 1);
      $data['akunPemasukan'] = $this->db->get_where('tb_rab')->result();
      // var_dump($data['akunPemasukan']);die;
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['pembayaran'] = $this->db->get('tb_pembayaran')->result();
      $this->load->view('admin/header', $data);
      $this->load->view($data['view'], $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('home/');
    }
  }

  public function index()
  {
    $this->db->where('is_active', 1);
    $this->db->where('kategori', 0);
    $kas = $this->db->get('tb_rab')->result();
    $this->db->where('is_active', 1);
    $this->db->where('kategori', 0);
    $akun = $this->db->get('tb_rab')->result();
    $data = [
      'title'   => 'Pengeluaran Kas',
      'view'    => 'transaksi/pengeluaran',
      'kas'     => $kas, 
      'akun'    => $akun
    ];
    $this->core($data);
  }

  public function add()
  {

    $this->form_validation->set_rules('nama', 'Diterima dari', 'trim|required');
    $this->form_validation->set_rules('nilai', 'Jumlah Pemasukan', 'trim|required');
    $this->form_validation->set_rules('akun_kas', 'Akun Kas', 'trim|required');
    $kategori = $this->input->post('kategori');
    $nilai = str_replace('.', '', $this->input->post('nilai'));

    $data = array(
      'inputer'   => $this->session->userdata('id'),
      'nama' => htmlspecialchars(strtoupper($this->input->post('nama'))),
      'id_trx' => htmlspecialchars($this->input->post('id_trx')),
      'kode' => 'PENGELUARAN KAS',
      'akun_kas' => $this->input->post('akun_kas'),
      'akun_trx' => $this->input->post('akun_trx'),
      'ta' => ($this->input->post('ta')),
      'kategori' => 0,
      'metode' => ($this->input->post('metode')),
      'debit' => ($kategori == 0) ? $nilai : 0,
      'kredit' => ($kategori == 1) ? $nilai : 0,
      'jumlah' => $nilai,
      'ket' => $this->input->post('ket'),
    );

    if ($this->form_validation->run() == TRUE) {
      $id = $this->input->post('id');
      if ($id) {
        $this->db->where('id', $id);
        $this->db->update('tb_transaksi', $data);
        $msg = 'Dada berhasil dirubah';
      } else {
        $this->db->set('date_created', $this->input->post('date') . ' ' . date('H:i:s'));
        $this->db->insert('tb_transaksi', $data);
        $msg = 'Dada berhasil ditambahkan';
      }
      if ($this->db->affected_rows()) {
        $result = [
          'sukses' => $msg
        ];
      } else {
        $result = [
          'error' => 'Proses gagal'
        ];
      }
    } else {
      $result = [
        'error' => validation_errors()
      ];
    }
    echo json_encode($result);
  }

  public function get()
  {
    $id = $this->input->post('id');
    $no = 1;
    $result = [];
    $saldo = 0;
    if (isset($id)) {
      $this->db->where('id', $id);
      $data = $this->db->get('tb_transaksi')->row();
      $result = [
        'date'  => substr($data->date_created, 0, 10),
        'jumlah'  => rupiah($data->jumlah),
        'ket'   => $data->ket,
        'akun_kas'   => $data->akun_kas,
        'nama'   => $data->nama,
        'metode'   => $data->metode,
        'id'    => $data->id,
        'ta'    => $data->ta,
        'id_trx'    => $data->id_trx,
        'id_murid'    => $data->id_murid,
      ];
    } else {
      $this->db->where('approve', 0);
      $this->db->where('kode', 'PENGELUARAN KAS');
      $data = $this->db->get('tb_transaksi')->result();
      foreach ($data as $key) {
        $this->db->where('kode_akun', $key->akun_kas);
        $kas = $this->db->get('tb_rab')->row();
        $this->db->where('id_sumber', $key->metode);
        $metode = $this->db->get('tb_metode')->row();
        $result[] = [
          'id'    => $key->id,
          'no'    => $no,
          'date'  => $key->date_created,
          'id_trx'    => $key->id_trx,
          'nama'  => $key->nama,
          'kas'  => $kas->nama,
          'metode'  => $metode->nama,
          'jumlah' => rupiah($key->jumlah),
          'ket'   => $key->ket,
        ];
        $no++;
      }
    }
    echo json_encode($result);
  }

  public function harian()
  {
    $this->db->group_by('created_at');
    $date = $this->db->get('tb_pemasukan')->result();

    $data = array();
    foreach ($date as $key) {
      $this->db->select_sum('kredit', 'total');
      $this->db->where('created_at', $key->created_at);
      $sum = $this->db->get('tb_pemasukan')->row();
      $data[] = array(
        'created_at' => $key->created_at,
        'inv' => $key->no_invoice,
        'total' => rupiah($sum->total)
      );
    }
    echo json_encode($data);
  }

  public function getKode()
  {
    // 0 pengeluaran
    $this->db->order_by('id', 'DESC');
    $data = $this->db->get('tb_transaksi')->result();

    $id_trx = $data[0]->id_trx;
    $id_trx = substr($id_trx, 0, -9);
    $id_trx = (int)$id_trx + 1;
    $id_trx = $id_trx . '.' . date('Ymd') . '0' . $this->session->userdata('id');

    $result = [
      'id_trx' => $id_trx
    ];
    echo json_encode($result);
  }
}


/* End of file Pemasukan.php */
/* Location: ./application/controllers/Pemasukan.php */
