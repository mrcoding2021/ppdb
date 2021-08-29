<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Invoice extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('tgl_indo');
    $this->load->helper('rupiah');
    $this->load->model('Model_global');
    $this->load->helper('terbilang');
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
      $data['parent'] = 'Data';
      $data['admin'] = $this->db->query($query)->result_array();
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $data['post'] = $this->db->get('tb_post')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['pembayaran'] = $this->db->get('tb_pembayaran')->result();
      $this->load->view('admin/header', $data);
      $this->load->view('laporan/invoice', $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('home/');
    }
  }

  public function index()
  {
    $data = [
      'title'   => 'Cari Invoice'
    ];
    $this->core($data);
  }

  public function get()
  {
    // $id = $_POST['id'];
    // $this->db->where('no_invoice', $id);
    $a = $this->db->get('tb_pembayaran')->result_array();
    echo json_encode($a, true);
  }

  public function cari()
  {
    $id = $this->input->post('id');
    // $id = '281.20210101';
    $this->db->where('no_invoice', $id);
    $result = $this->db->get('tb_transaksi')->result();

    for ($i = 0; $i < count($result); $i++) {
      $this->db->where('id_user', $result[0]->id_murid);
      $user = $this->db->get('tb_user')->row();

      $this->db->where('kode_akun', $result[$i]->byr_utk);
      $akun = $this->db->get('tb_rab')->row_array();

      $this->db->where('id', $akun['parent']);
      $parent = $this->db->get('tb_rab')->row_array();

      $this->db->where('no_invoice', $result[0]->no_invoice);
      $this->db->select_sum('jumlah', 'total');
      $this->db->where('acc', 1);
      $total = $this->db->get('tb_pembayaran')->row();

      $data[] = [
        'nama' => $user->nama,
        'kelas' => $user->kelas,
        'nis'   => $user->nis,
        'pj'   => $user->pj,
        'hp'   => $user->hp,
        'ta'   => $result[$i]->ta,
        'ket' => ($result[$i]->ket == '') ? '-' : $result[$i]->ket,
        'bayar' => strtoupper($parent['nama'] . ' ' . $akun['nama']),
        'sumber'  => $result[$i]->id_sumber,
        'i_o' => $result[$i]->i_o,
        'debit' => rupiah($result[$i]->debit),
        'kredit' => rupiah($result[$i]->kredit),
        'diskon' => rupiah($result[$i]->diskon),
        'jumlah' => rupiah($result[$i]->jumlah),
        'grandtotal' => rupiah($total->total),
        'terbilang' => '"' . str_replace('Koma ', '', number_to_words($total->total)) . 'Rupiah"'
      ];
    }

    echo json_encode($data);
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
