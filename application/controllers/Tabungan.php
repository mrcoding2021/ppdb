<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Tabungan extends CI_Controller
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
      $data['admin'] = $this->db->query($query)->result_array();
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $this->db->order_by('id_paket', 'DESC');
      $data['produk'] = $this->db->get('paket')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['slider'] = $this->db->get('tb_slider')->result_array();

      $this->load->view('admin/header', $data);
      $this->load->view($data['view'], $data);
      $this->load->view('admin/footer', $data);
    } else {
      # code...
      redirect('home');
    }
  }

  public function index()
  {
    $data = [
      'title'   => 'Input Tabungan',
      'view'    => 'tabungan/index',
      'parent'  => 'Tabungan'
    ];
    $this->core($data);
  }

  public function report()
  {
    $this->db->select_sum('kredit', 'total');
    $this->db->where('kode', 'TABUNGAN');
    $this->db->where('approve', 1);
    $kredit = $this->db->get('tb_transaksi')->row();

    $this->db->select_sum('debit', 'total');
    $this->db->where('kode', 'TABUNGAN');
    $this->db->where('approve', 1);
    $debit = $this->db->get('tb_transaksi')->row();
    $saldoAll = (int)$kredit->total - (int)$debit->total;

    $this->db->select_sum('kredit', 'total');
    $this->db->where('year(date_created)', date('Y'));
    $this->db->where('kode', 'TABUNGAN');
    $this->db->where('approve', 1);
    $kredit1 = $this->db->get('tb_transaksi')->row();
    
    $this->db->select_sum('debit', 'total');
    $this->db->where('year(date_created)', date('Y'));
    $this->db->where('kode', 'TABUNGAN');
    $this->db->where('approve', 1);
    $debit1 = $this->db->get('tb_transaksi')->row();
    $saldoTahunIni = (int)$kredit1->total - (int)$debit1->total;

    $this->db->select_sum('kredit', 'total');
    $this->db->where('year(date_created)', date('Y'));
    $this->db->where('month(date_created)', date('m'));
    $this->db->where('kode', 'TABUNGAN');
    $this->db->where('approve', 1);
    $kredit3 = $this->db->get('tb_transaksi')->row();
    
    $this->db->select_sum('debit', 'total');
    $this->db->where('year(date_created)', date('Y'));
    $this->db->where('month(date_created)', date('m'));
    $this->db->where('kode', 'TABUNGAN');
    $this->db->where('approve', 1);
    $debit3 = $this->db->get('tb_transaksi')->row();
    $saldoBulanIni = (int)$kredit3->total - (int)$debit3->total;

    $this->db->select_sum('kredit', 'total');
    $this->db->where('year(date_created)', date('Y'));
    $this->db->where('month(date_created)', date('m'));
    $this->db->where('day(date_created)', date('d'));
    $this->db->where('kode', 'TABUNGAN');
    $this->db->where('approve', 1);
    $kredit4 = $this->db->get('tb_transaksi')->row();
    
    $this->db->select_sum('debit', 'total');
    $this->db->where('year(date_created)', date('Y'));
    $this->db->where('month(date_created)', date('m'));
    $this->db->where('day(date_created)', date('d'));
    $this->db->where('kode', 'TABUNGAN');
    $this->db->where('approve', 1);
    $debit4 = $this->db->get('tb_transaksi')->row();
    $saldoHariIni = (int)$kredit4->total - (int)$debit4->total;
    
    $data = [
      'title'   => 'Laporan Tabungan',
      'view'    => 'tabungan/report',
      'parent'  => 'Tabungan',
      'saldoAll'  => $saldoAll,
      'saldoTahunIni'   => $saldoTahunIni,
      'saldoBulanIni'   => $saldoBulanIni,
      'saldoHariIni' => ($saldoHariIni) ?? 0
    ];
    $this->core($data);
  }

  public function add()
  {
    if ($this->scm->cekSecurity() == true) {
      $this->form_validation->set_rules('nilai', 'Nilai Tabungan', 'trim|required');
      $this->form_validation->set_rules('id_murid', 'Nilai Tabungan', 'trim|required');
      $kategori = $this->input->post('kategori');
      $nilai = str_replace('.', '', $this->input->post('nilai'));

      $data = array(
        'inputer'   => $this->session->userdata('id'),
        'id_murid' => htmlspecialchars($this->input->post('id_murid')),
        'id_trx' => htmlspecialchars($this->input->post('id_trx')),
        'kode' => 'TABUNGAN',
        'akun_kas' => '0-10005',
        'akun_trx' => '0-10005',
        'ta' => ($this->input->post('ta')),
        'kategori' => ($this->input->post('kategori')),
        'metode' => ($this->input->post('metode')),
        'debit' => ($kategori == 0) ? $nilai : 0,
        'kredit' => ($kategori == 1) ? $nilai : 0,
        'jumlah' => $nilai,
        'ket' => $this->input->post('ket'),
        'approve' => 1
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
  }

  public function getTabungan($id_murid = '')
  {
    if ($this->scm->cekSecurity() == true) {
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
          'kategori'   => $data->kategori,
          'metode'   => $data->metode,
          'id'    => $data->id,
          'ta'    => $data->ta,
          'id_trx'    => $data->id_trx,
          'id_murid'    => $data->id_murid,
        ];
      } else {
        $this->db->where('approve', 1);
        $this->db->where('id_murid', $id_murid);
        $this->db->where('kode', 'TABUNGAN');
        $data = $this->db->get('tb_transaksi')->result();
        foreach ($data as $key) {

          if ($key->debit == 0) {
            $saldo = $saldo + $key->kredit;
          } else {
            $saldo = $saldo + $key->kredit - $key->debit;
          }

          $result[] = [
            'no'    => $no,
            'date'  => $key->date_created,
            'debit' => rupiah($key->debit),
            'kredit'  => rupiah($key->kredit),
            'saldo' => rupiah($saldo),
            'ket'   => $key->ket,
            'id'    => $key->id,
            'id_trx'    => $key->id_trx,
          ];
          $no++;
        }
      }
      echo json_encode($result);
    }
  }

  public function getAll($bln = '', $thn = '', $hari = '')
  {
    if ($this->scm->cekSecurity() == true) {
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
          'kategori'   => $data->kategori,
          'metode'   => $data->metode,
          'id'    => $data->id,
          'ta'    => $data->ta,
          'id_trx'    => $data->id_trx,
          'id_murid'    => $data->id_murid,
        ];
      } else {
        if ($hari == 0) {
          $this->db->where('month(date_created)', $bln);
          $this->db->where('year(date_created)', $thn);
        } else {
          $this->db->where('day(date_created)', $hari);
          $this->db->where('month(date_created)', $bln);
          $this->db->where('year(date_created)', $thn);
        }
        $this->db->where('approve', 1);
        $this->db->where('kode', 'TABUNGAN');
        $data = $this->db->get('tb_transaksi')->result();

        foreach ($data as $key) {

          if ($key->debit == 0) {
            $saldo = $saldo + $key->kredit;
          } else {
            $saldo = $saldo + $key->kredit - $key->debit;
          }

          $this->db->where('id_user', $key->id_murid);
          $murid = $this->db->get('tb_user')->row();
          
          $result[] = [
            'no'    => $no,
            'nama'  => $murid->nama,
            'hp'  => $murid->hp,
            'date'  => $key->date_created,
            'debit' => rupiah($key->debit),
            'kredit'  => rupiah($key->kredit),
            'saldo' => rupiah($saldo),
            'ket'   => $key->ket,
            'id'    => $key->id,
            'id_trx'    => $key->id_trx,
          ];
          $no++;
        }
      }
      echo json_encode($result);
    }
  }

  public function getKode()
  {
    // 6 kode kas tabungan
    if ($this->scm->cekSecurity() == true) {
      $this->db->order_by('id', 'DESC');
      $data = $this->db->get('tb_transaksi')->result();

      $id_trx = $data[0]->id_trx;
      $id_trx = substr($id_trx, 0, -9);
      $id_trx = (int)$id_trx + 1;
      $id_trx = $id_trx . '.' . date('Ymd') . '6';

      $result = [
        'id_trx' => $id_trx
      ];
      echo json_encode($result);
    }
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
