<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

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
      $this->load->view('pembayaran/v_pembayaran', $data);
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
    $id_trx = str_replace(' ', '', $this->input->post('inv'));

    $this->db->select('id_trx');
    $this->db->where('id_trx', $id_trx);
    $trx = $this->db->get('tb_transaksi')->result();
    if ($id_trx == 0) {
      $msg = array(
        'error' => 'Tidak ada nama dan nilai tagihan, Silahkan isi nama siswa dan pilih tahun ajaran terlebih dulu'
      );
    } else {
      if ($trx != null) {
        $msg = array(
          'error' => 'No. invoice sudah ada, silahkan tambah transaksi baru !'
        );
      } else {
        $kode = ['SPP', 'INFAQ GEDUNG', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU', 'SARPRAS'];
        $akun =  $this->input->post('akun_trx');
        for ($i = 0; $i < count($kode); $i++) {
          if ($akun[$i] == 0) {
            $alert = 'Kode Akun ' . $kode[$i] . ' tidak boleh kosong';
            break;
          } else {
            if ($akun[0] != 0 && $akun[1] != 0 && $akun[2] != 0 && $akun[3] != 0 && $akun[4] != 0 && $akun[5] != 0 && $akun[6] != 0) {
              $data = [
                'date_created' => $this->input->post('tgl_byr') . ' ' . date('H:i:s'),
                'date' => $this->input->post('tgl_byr'),
                'time' => date('H:i:s'),
                'inputer'   => $this->session->userdata('id'),
                'id_murid'     => $this->input->post('id_murid'),
                'id_trx'       => $id_trx,
                'ta'           => $this->input->post('ta'),
                'kode'         => $kode[$i],
                'akun_kas'     => '0-10001',
                'akun_trx'     => $akun[$i],
                'tagihan'        => str_replace('.', '', $this->input->post('tagihan')[$i]),
                'metode'       => $this->input->post('metode')[$i],
                'kredit'        => $this->input->post('jml_byr')[$i],
                'diskon'       => $this->input->post('diskon')[$i],
                'jumlah'        => $this->input->post('jml')[$i],
                'ket'          => $this->input->post('ket')[$i],
                'kelas'       => $this->input->post('kelas'),
                'approve'      => 0
              ];
              $this->db->insert('tb_transaksi', $data);
            } else {
              $this->db->where('id_trx', $id_trx);
              $this->db->delete('tb_transaksi');
              $alert = 'Kode Akun ' . $kode[$i] . ' tidak boleh kosong';
            }
          }
        }

        if ($this->db->affected_rows() > 0) {
          $plus = 1;
          for ($i = 0; $i < count($kode); $i++) {
            if ($this->input->post('metode')[$i] == 3) {
              $kode_trx = explode('.', $id_trx);
              $tab = [
                'date_created' => $this->input->post('tgl_byr') . ' ' . date('H:i:s'),
                'date' => $this->input->post('tgl_byr'),
                'time' => date('H:i:s'),
                'inputer'   => $this->session->userdata('id'),
                'id_trx'    => (int)$kode_trx[0] + $plus . '.' . str_replace('-', '', $this->input->post('tgl_byr')) . '6',
                'id_murid'  => $this->input->post('id_murid'),
                'metode'    => $this->input->post('metode')[$i],
                'debit'     => $this->input->post('jml_byr')[$i],
                'diskon'    => $this->input->post('diskon')[$i],
                'jumlah'    => $this->input->post('jml')[$i],
                'kode'      => 'TABUNGAN',
                'kelas'     => $this->input->post('kelas'),
                'approve'   => 1,
                'akun_kas'  => '0-10005',
                'akun_trx'  => $akun[$i],
                'ta'        => $this->input->post('ta'),
                'kategori'  => 0,
                'ket'       => 'Penbayaran ' . $kode[$i] . ' Tahun Ajaran ' . $this->input->post('ta'),
              ];
              $this->db->insert('tb_transaksi', $tab);
            }
            $plus++;
          }
          $msg = array(
            'sukses' => 'Data Pembayaran berhasil tersimpan'
          );
        } else {
          $msg = array(
            'error' => $alert
          );
        }
      }
    }

    echo json_encode($msg);
  }

  public function getPembayaran($start, $end)
  {
    if ($this->scm->cekSecurity() == true) {
      // $this->db->order_by('date_created', 'asc');
      $start = explode('-', $start);
      $end = explode('-', $end);

      $this->db->where('day(date_created) >=', $start[2]);
      $this->db->where('month(date_created) >=', $start[1]);
      $this->db->where('year(date_created) >=', $start[0]);
      $this->db->where('day(date_created) <=', $end[2]);
      $this->db->where('month(date_created) <=', $end[1]);
      $this->db->where('year(date_created) <=', $end[0]);
      $this->db->where('approve', 1);
      $this->db->where_not_in('kode', 'TABUNGAN');
      $this->db->where_not_in('kode', 'PEMASUKAN KAS');
      $this->db->where_not_in('kode', 'PENGELUARAN KAS');
      $this->db->select('id_trx');
      $this->db->where('kategori', 1);
      $this->db->group_by('tb_transaksi.id_trx');
      $data = $this->db->get('tb_transaksi')->result();

      $result = [];
      $no = 1;

      foreach ($data as $key) {

        $this->db->select_sum('jumlah', 'total');
        $this->db->where('id_trx', $key->id_trx);
        $jumlah = $this->db->get('tb_transaksi')->row();

        $this->db->where('id_trx', $key->id_trx);
        $trx = $this->db->get('tb_transaksi')->row();

        $this->db->where('id_user', $trx->id_murid);
        $siswa = $this->db->get('tb_user')->row();

        $result[] = [
          'no'      => $no,
          'tgl'     => $trx->date_created,
          'id'     => $trx->id,
          'inv'     => $trx->id_trx,
          'kelas'     => $trx->kelas,
          'siswa'   => ($siswa != null) ? $siswa->nama : '0',
          'ta'      => $trx->ta,
          'jumlah'  => rupiah($jumlah->total),
        ];
        $no++;
      }
      echo json_encode($result);
    }
  }

  public function export($start, $end, $id = 'excel')
  {   
    $spreadsheet = new Spreadsheet();
    $excel = $spreadsheet->getActiveSheet();
    $nama_bln = strtoupper(($start) . ' - ' . ($end));

    $excel->setCellValue('A1', "LAPORAN PEMBAYARAN SISWA");
    $excel->setCellValue('A2', "SDIT INSAN MULIA BEKASI");
    $excel->setCellValue('A3', $nama_bln);

    $excel->getPageMargins()->setTop(1);
    $excel->getPageMargins()->setRight(0.25);
    $excel->getPageMargins()->setLeft(0.25);
    $excel->getPageMargins()->setBottom(1);

    $excel->getPageSetup()->setHorizontalCentered(true);
    $excel->getPageSetup()->setVerticalCentered(false);

    $style_col = array(
      'font' => [
        'bold' => true,
      ],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
        'outline' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
        ],
      ],
      'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
        'startColor' => [
          'argb' => 'F1FF26',
        ],
        'endColor' => [
          'argb' => 'F1FF26',
        ],
      ],
    );

    $style_row = array(
      'font' => [
        'size' => '10'
      ],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      ],
      'borders' => [
        'outline' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
    );

    $style_number = array(
      'font' => [
        'size' => '10'
      ],
      'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ],
      'borders' => [
        'outline' => [
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
      ],
    );

    $excel->mergeCells('A1:G1');
    $excel->mergeCells('A2:G2');
    $excel->mergeCells('A3:G3');
    $excel->getStyle('A1')->getFont()->setBold(TRUE);
    $excel->getStyle('A2')->getFont()->setBold(TRUE);
    $excel->getStyle('A3')->getFont()->setBold(TRUE);
    $excel->getStyle('A1')->getFont()->setSize(15);

    $center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

    $excel->getStyle('A1')->getAlignment()->setHorizontal($center);
    $excel->getStyle('A2')->getAlignment()->setHorizontal($center);
    $excel->getStyle('A3')->getAlignment()->setHorizontal($center);

    $excel->setCellValue('A5', "No.");
    $excel->setCellValue('B5', "Tanggal");
    $excel->setCellValue('C5', "Nama Siswa");
    $excel->setCellValue('D5', "Kelas");
    $excel->setCellValue('E5', "TA");
    $excel->setCellValue('F5', "Jumlah");
    $excel->setCellValue('G5', "Saldo");

    $excel->getStyle('A5')->applyFromArray($style_col);
    $excel->getStyle('B5')->applyFromArray($style_col);
    $excel->getStyle('C5')->applyFromArray($style_col);
    $excel->getStyle('D5')->applyFromArray($style_col);
    $excel->getStyle('E5')->applyFromArray($style_col);
    $excel->getStyle('F5')->applyFromArray($style_col);
    $excel->getStyle('G5')->applyFromArray($style_col);

    $border = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;

    if ($this->scm->cekSecurity() == true) {

      $start = explode('-', $start);
      $end = explode('-', $end);
      $this->db->where('day(date_created) >=', $start[2]);
      $this->db->where('month(date_created) >=', $start[1]);
      $this->db->where('year(date_created) >=', $start[0]);
      $this->db->where('day(date_created) <=', $end[2]);
      $this->db->where('month(date_created) <=', $end[1]);
      $this->db->where('year(date_created) <=', $end[0]);
      $this->db->where('approve', 1);
      $this->db->where_not_in('kode', 'TABUNGAN');
      $this->db->where_not_in('kode', 'PEMASUKAN KAS');
      $this->db->where_not_in('kode', 'PENGELUARAN KAS');
      $this->db->select('id_trx');
      $this->db->where('kategori', 1);
      $this->db->group_by('tb_transaksi.id_trx');
      $data = $this->db->get('tb_transaksi')->result();
    }
    $saldo = 0;
    $no = 1;
    foreach ($data as $key) {
      $this->db->where('id_trx', $key->id_trx);
      $trx = $this->db->get('tb_transaksi')->result();
      $this->db->where('id_user', $trx[0]->id_murid);
      $siswa = $this->db->get('tb_user')->row();
      $this->db->select_sum('jumlah', 'total');
      $this->db->where('id_trx', $key->id_trx);
      $jumlah = $this->db->get('tb_transaksi')->row();

      if ($jumlah->total > 0) {
        $saldo = $saldo + $jumlah->total;
      }

      $result[] = [
        // 'id'    => $key->id,
        'no'    => $no,
        'date'  => $trx[0]->date_created,
        'id_trx'    => $key->id_trx,
        'nama'  => $siswa->nama,
        'kelas' => $trx[0]->kelas,
        'ta' => $trx[0]->ta,
        'jumlah' => $jumlah->total,
        'saldo' => $saldo,
      ];
      $no++;
    }

    $m = 6;
    if ($result) {
      foreach ($result as $res) {
        $excel->setCellValue('A' . $m, $res['no']);
        $excel->setCellValue('B' . $m, shortdate_indo(substr($res['date'], 0, 10)));
        $excel->setCellValue('C' . $m, $res['nama']);
        $excel->setCellValue('D' . $m, $res['kelas']);
        $excel->setCellValue('E' . $m, $res['ta']);
        $excel->setCellValue('F' . $m, $res['jumlah']);
        $excel->setCellValue('G' . $m, $res['saldo']);

        $excel->getStyle('A' . $m)->applyFromArray($style_row);
        $excel->getStyle('B' . $m)->applyFromArray($style_row);
        $excel->getStyle('C' . $m)->getBorders()->getOutline()->setBorderStyle($border);
        $excel->getStyle('D' . $m)->getBorders()->getOutline()->setBorderStyle($border);
        $excel->getStyle('E' . $m)->applyFromArray($style_row);
        $excel->getStyle('F' . $m)->applyFromArray($style_number);
        $excel->getStyle('F' . $m)->applyFromArray($style_number);
        $excel->getStyle('G' . $m)->applyFromArray($style_number);

        $no++;
        $m++;
      }
    }

    $excel->getColumnDimension('A')->setWidth(5);
    $excel->getColumnDimension('B')->setWidth(12);
    $excel->getColumnDimension('C')->setWidth(40);
    $excel->getColumnDimension('D')->setWidth(40);
    $excel->getColumnDimension('E')->setWidth(15);
    $excel->getColumnDimension('F')->setWidth(15);
    $excel->getColumnDimension('G')->setWidth(15);

    $excel->getDefaultRowDimension()->setRowHeight(-1);

    $filepath = 'Laporan Pembayaran Siswa ' . $nama_bln;
    if ($id == 'excel') {
      $writer = new Xlsx($spreadsheet);
      $writer->save($filepath);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="' . basename($filepath) . '".xlsx"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filepath));
      flush();
      readfile($filepath);
      exit;
    } else {
      $spreadsheet->getActiveSheet()->getPageSetup()
        ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
      $spreadsheet->getActiveSheet()->getPageSetup()
        ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

      $writer = new Dompdf($spreadsheet);
      $writer->save($filepath);

      header('Content-Type: application/pdf');
      header('Content-Disposition: attachment; filename="' . basename($filepath) . '".pdf"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filepath));
      flush();     // readfile($filepath); 
      readfile($filepath);
      exit;
    }
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Pembayaran.php */
