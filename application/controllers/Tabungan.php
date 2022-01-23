<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

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
      $this->form_validation->set_rules('id_murid', 'ID Murid', 'trim|required');
      $kategori = $this->input->post('kategori');
      $nilai = str_replace('.', '', $this->input->post('nilai'));

      $data = array(
        'inputer'   => $this->session->userdata('id'),
        'id_murid' => htmlspecialchars($this->input->post('id_murid')),
        'id_trx' => htmlspecialchars($this->input->post('id_trx')),
        'date' => $this->input->post('date'),
        'time' => date('H:i:s'),
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
        if ($this->db->affected_rows() > 0) {
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
        $this->db->order_by('date_created', 'asc');
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

  public function getAll($start, $end)
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
        $this->db->order_by('date_created', 'asc');
        if ($start != 0) {
          $this->db->where('date >=', $start);
          $this->db->where('date <=', $end);
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
          if ($murid == null) {
            $namaSiswa = 'SEKOLAH';
            $hp = '000';
          } else {
            $namaSiswa = $murid->nama;
            $hp = $murid->hp;
          }

          $result[] = [
            'no'    => $no,
            'nama'  => $namaSiswa,
            'hp'  => $hp,
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

  public function export($start, $end, $id = 'excel')
  {
    $spreadsheet = new Spreadsheet();
    $excel = $spreadsheet->getActiveSheet();
    $nama_bln = strtoupper(($start) . ' - ' . ($end));

    $excel->setCellValue('A1', "LAPORAN REKAP TABUGNAN");
    $excel->setCellValue('A2', "SDIT INSAN MULIA BEKASI");
    $excel->setCellValue('A3', $nama_bln); // Set kolom A1 dengan tulisan "DATA SISWA"

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
    $excel->mergeCells('A3:G3'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getStyle('A1')->getFont()->setBold(TRUE);
    $excel->getStyle('A2')->getFont()->setBold(TRUE);
    $excel->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1

    $center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

    $excel->getStyle('A1')->getAlignment()->setHorizontal($center);
    $excel->getStyle('A2')->getAlignment()->setHorizontal($center);
    $excel->getStyle('A3')->getAlignment()->setHorizontal($center);
    //format dalam excel nantinya
    $excel->setCellValue('A5', "No."); // Set kolom A5 dengan tulisan "NO"
    $excel->setCellValue('B5', "Tanggal"); // Set kolom B5 dengan tulisan "NIS"
    $excel->setCellValue('C5', "Nama Siswa"); // Set kolom C5 dengan tulisan "NAMA"
    $excel->setCellValue('D5', "No Hp"); // Set kolom D5 dengan tulisan "JENIS KELAMIN"
    $excel->setCellValue('E5', "Debit");
    $excel->setCellValue('F5', "Kredit");
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
      $this->db->order_by('date_created', 'asc');
      if ($start != 0) {
        $this->db->where('date >=', $start);
        $this->db->where('date <=', $end);
      }
      $this->db->where('approve', 1);
      $this->db->where('kode', 'TABUNGAN');
      $data = $this->db->get('tb_transaksi')->result();
    }
    $saldo = 0;
    $no = 1;
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
        'date'  => mediumdate_indo(substr($key->date_created, 0, 10)),
        'debit' => $key->debit,
        'kredit'  => $key->kredit,
        'saldo' => $saldo,
        'ket'   => $key->ket,
        'id'    => $key->id,
        'id_trx'    => $key->id_trx,
      ];
      $no++;
    }

    $m = 6;
    if ($result) {
      foreach ($result as $res) {
        $excel->setCellValue('A' . $m, $res['no']);
        $excel->setCellValue('B' . $m, $res['date']);
        $excel->setCellValue('C' . $m, $res['nama']);
        $excel->setCellValue('D' . $m, $res['hp']);
        $excel->setCellValue('E' . $m, $res['debit']);
        $excel->setCellValue('F' . $m, $res['kredit']);
        $excel->setCellValue('G' . $m, $res['saldo']);

        $excel->getStyle('A' . $m)->applyFromArray($style_row);
        $excel->getStyle('B' . $m)->applyFromArray($style_row);
        $excel->getStyle('C' . $m)->getBorders()->getOutline()->setBorderStyle($border);
        $excel->getStyle('D' . $m)->getBorders()->getOutline()->setBorderStyle($border);
        $excel->getStyle('E' . $m)->applyFromArray($style_number);
        $excel->getStyle('F' . $m)->applyFromArray($style_number);
        $excel->getStyle('G' . $m)->applyFromArray($style_number);

        $no++;
        $m++;
      }
    }

    $excel->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getColumnDimension('B')->setWidth(12); // Set width kolom B
    $excel->getColumnDimension('C')->setWidth(40); // Set width kolom C
    $excel->getColumnDimension('D')->setWidth(15); // Set width kolom D
    $excel->getColumnDimension('E')->setWidth(15);
    $excel->getColumnDimension('F')->setWidth(15);
    $excel->getColumnDimension('G')->setWidth(15);
    $excel->getColumnDimension('H')->setWidth(30); // Set width kolom E

    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getDefaultRowDimension()->setRowHeight(-1);

    $filepath = 'Laporan Rekap Tabungan ' . $nama_bln;
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

  public function exportData($id = '')
  {
    $this->db->where('id_user', $id);
    $user = $this->db->get('tb_user')->row();

    $spreadsheet = new Spreadsheet();
    $excel = $spreadsheet->getActiveSheet();

    $excel->setCellValue('A1', "LAPORAN REKAP TABUGNAN");
    $excel->setCellValue('A2', "SDIT INSAN MULIA BEKASI");
    $excel->setCellValue('A3', $user->nama); // Set kolom A1 dengan tulisan "DATA SISWA"

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

    $excel->mergeCells('A1:E1');
    $excel->mergeCells('A2:E2');
    $excel->mergeCells('A3:E3'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getStyle('A1')->getFont()->setBold(TRUE);
    $excel->getStyle('A2')->getFont()->setBold(TRUE);
    $excel->getStyle('A3')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1

    $center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

    $excel->getStyle('A1')->getAlignment()->setHorizontal($center);
    $excel->getStyle('A2')->getAlignment()->setHorizontal($center);
    $excel->getStyle('A3')->getAlignment()->setHorizontal($center);
    //format dalam excel nantinya
    $excel->setCellValue('A5', "No."); // Set kolom A5 dengan tulisan "NO"
    $excel->setCellValue('B5', "Tanggal"); // Set kolom B5 dengan tulisan "NIS"
    $excel->setCellValue('C5', "Debit");
    $excel->setCellValue('D5', "Kredit");
    $excel->setCellValue('E5', "Saldo");

    $excel->getStyle('A5')->applyFromArray($style_col);
    $excel->getStyle('B5')->applyFromArray($style_col);
    $excel->getStyle('C5')->applyFromArray($style_col);
    $excel->getStyle('D5')->applyFromArray($style_col);
    $excel->getStyle('E5')->applyFromArray($style_col);

    $border = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;

    if ($this->scm->cekSecurity() == true) {
      $this->db->order_by('date_created', 'asc');
      $this->db->where('approve', 1);
      $this->db->where('id_murid', $id);
      $this->db->where('kode', 'TABUNGAN');
      $data = $this->db->get('tb_transaksi')->result();
    }
    $saldo = 0;
    $no = 1;
    foreach ($data as $key) {

      if ($key->debit == 0) {
        $saldo = $saldo + $key->kredit;
      } else {
        $saldo = $saldo + $key->kredit - $key->debit;
      }

      $result[] = [
        'no'    => $no,
        'date'  => mediumdate_indo(substr($key->date_created, 0, 10)),
        'debit' => $key->debit,
        'kredit'  => $key->kredit,
        'saldo' => $saldo,
        'ket'   => $key->ket,
      ];
      $no++;
    }

    $m = 6;
    if ($result) {
      foreach ($result as $res) {
        $excel->setCellValue('A' . $m, $res['no']);
        $excel->setCellValue('B' . $m, $res['date']);
        $excel->setCellValue('C' . $m, $res['debit']);
        $excel->setCellValue('D' . $m, $res['kredit']);
        $excel->setCellValue('E' . $m, $res['saldo']);

        $excel->getStyle('A' . $m)->applyFromArray($style_row);
        $excel->getStyle('B' . $m)->applyFromArray($style_row);
        $excel->getStyle('C' . $m)->applyFromArray($style_row);
        $excel->getStyle('D' . $m)->applyFromArray($style_row);
        $excel->getStyle('E' . $m)->applyFromArray($style_row);;

        $no++;
        $m++;
      }
    }

    $excel->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getColumnDimension('B')->setWidth(12); // Set width kolom B
    $excel->getColumnDimension('C')->setWidth(12); // Set width kolom C
    $excel->getColumnDimension('D')->setWidth(15); // Set width kolom D
    $excel->getColumnDimension('E')->setWidth(15);

    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getDefaultRowDimension()->setRowHeight(-1);

    $filepath = 'Rekap Tabungan ' . $user->nama;

    $spreadsheet->getActiveSheet()->getPageSetup()
      ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
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

  public function delete()
  {
    $id = $this->input->post('id');
    $this->db->where('id', $id);
    $this->db->delete('tb_transaksi');
    if ($this->db->affected_rows()) {
      $result = [
        'sukses' => 'Data berhasil terhapus permanen'
      ];
    } else {
      $result = [
        'error' => 'Proses gagal'
      ];
    }
    echo json_encode($result);
  }

  public function ubahTanggal()
  {
    // $this->db->where('kode', 'TABUNGAN');
    $date = $this->db->get('tb_transaksi')->result();
    
    foreach ($date as $key) {
      if ($key->date == '0000-00-00') {
        $this->db->where('id', $key->id);
        $this->db->set('date', substr($key->date_created,0,10));
        $this->db->update('tb_transaksi');
        
      }
      
    }
    echo 'Sukses';
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
