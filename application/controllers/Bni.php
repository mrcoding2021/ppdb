<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

class Bni extends CI_Controller
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

    $data = [
      'title'   => 'Setoran BNI',
      'view'    => 'bni/index',
      'kas'     => $kas
    ];
    $this->core($data);
  }

  public function report()
  {
    $this->db->where('is_active', 1);
    $this->db->where('kategori', 0);
    $kas = $this->db->get('tb_rab')->result();

    $this->db->where('approve', 1);
    $this->db->where('kode', 'SETORAN BSI');
    $this->db->select_sum('kredit', 'total');
    $saldoAll = $this->db->get('tb_transaksi')->row();

    $this->db->where('approve', 1);
    $this->db->where('kode', 'SETORAN BSI');
    $this->db->where('ta', '2021-2022');
    $this->db->select_sum('kredit', 'total');
    $saldoTahunIni = $this->db->get('tb_transaksi')->row();

    $this->db->where('approve', 1);
    $this->db->where('kode', 'SETORAN BSI');
    $this->db->where('month(date_created)', date('m'));
    $this->db->select_sum('kredit', 'total');
    $saldobulanIni = $this->db->get('tb_transaksi')->row();
    $this->db->where('approve', 1);
    $this->db->where('kode', 'SETORAN BSI');
    $this->db->where('month(date_created)', date('m'));
    $this->db->where('day(date_created)', date('d'));
    $this->db->select_sum('kredit', 'total');
    $saldoHariIni = $this->db->get('tb_transaksi')->row();

    $data = [
      'title'   => 'Laporan Setoran BSI',
      'view'    => 'bni/report',
      'kas'     => $kas,
      'saldoAll' => $saldoAll->total,
      'saldoTahunIni' => $saldoTahunIni->total,
      'saldoBulanIni' => $saldobulanIni->total,
      'saldoHariIni' => $saldoHariIni->total,
    ];
    $this->core($data);
  }

  public function add()
  {

    $this->form_validation->set_rules('nama', 'Nama Penyetor', 'trim|required');
    $this->form_validation->set_rules('nilai[]', 'Nilai Setoran', 'trim|required');

    $jumlah = str_replace('.', '', $this->input->post('jumlah'));
    $nilai = str_replace('.', '', $this->input->post('nilai'));
    $id = $this->input->post('id');
    $i = 0;
    $kode = ['SPP', 'INFAQ GEDUNG', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU', 'SARPRAS', 'FORMULIR'];
    foreach ($kode as $k) {

      $data = array(
        'inputer'   => $this->session->userdata('id'),
        'nama' => htmlspecialchars(strtoupper($this->input->post('penyetor'))),
        'id_trx' => htmlspecialchars($this->input->post('id_trx')),
        'kode' => 'SETORAN BSI',
        'akun_kas' => '0-10001',
        'akun_trx' => '0-10001',
        'kategori' => 1,
        'metode' => 2,
        'debit' => 0,
        'id_murid' => $this->input->post('id_murid'),
        'ta' => $this->input->post('ta'),
        'bank' => $this->input->post('bank'),
        'kelas' => $this->input->post('kelas'),
        'kredit' => $nilai[$i],
        'jumlah' => $nilai[$i],
        'total' => $jumlah,
        'ket' => $k,
      );
      $i++;
      $this->db->set('date_created', $this->input->post('date') . ' ' . $this->input->post('time'));
      $this->db->insert('tb_transaksi', $data);
      $msg = 'Data berhasil ditambahkan';
    }

    if ($this->form_validation->run() == TRUE) {
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

  public function edit()
  {

    $this->form_validation->set_rules('nama', 'Nama Penyetor', 'trim|required');
    $this->form_validation->set_rules('nilai[]', 'Nilai Setoran', 'trim|required');

    $jumlah = str_replace('.', '', $this->input->post('jumlah'));
    $nilai = str_replace('.', '', $this->input->post('nilai'));
    $id = $this->input->post('id');
    $i = 0;
    // $kode = ['SPP', 'INFAQ GEDUNG', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU', 'SARPRAS', 'FORMULIR'];
    for ($i = 0; $i < 8; $i++) {
      $data = array(
        'nama' => htmlspecialchars(strtoupper($this->input->post('penyetor'))),
        'ta' => $this->input->post('ta'),
        'bank' => $this->input->post('bank'),
        'kredit' => $nilai[$i],
        'jumlah' => $nilai[$i],
        'total' => $jumlah,
      );
      $this->db->where('id', $id[$i]);
      $this->db->update('tb_transaksi', $data);
      $msg = 'Data berhasil dirubah';
    }

    if ($this->form_validation->run() == TRUE) {
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

  public function approve()
  {
    $id = $this->input->post('id');
    $this->db->set('approve', 1);
    $this->db->where('id_trx', $id);
    $this->db->update('tb_transaksi');
    $msg = 'Data berhasil masuk ke pembukuan';
    if ($this->db->affected_rows()) {
      $result = [
        'sukses' => $msg
      ];
    } else {
      $result = [
        'error' => 'Proses gagal'
      ];
    }

    echo json_encode($result);
  }

  public function get()
  {
    $id = $this->input->post('id');
    $no = 1;
    $result = [];

    if (isset($id)) {
      $this->db->where('id_trx', $id);
      $data = $this->db->get('tb_transaksi')->result();
      foreach ($data as $da) {
        $this->db->where('id_user', $da->id_murid);
        $user = $this->db->get('tb_user')->row();
        $result[] = [
          'id_trx'  => $id,
          'id'    => $da->id,
          'bank'    => $da->bank,
          'date'  => substr($da->date_created, 0, 10),
          'time'  => substr($da->date_created, 11),
          'ta'    => $da->ta,
          'penyetor'  => $da->nama,
          'bank'  => $da->bank,
          'nama'  => $user->nama,
          'wali'  => $user->pj,
          'kelas'  => $da->kelas,
          'nilai' => rupiah($da->jumlah),
          'jumlah' => rupiah($da->total)
        ];
      }
    } else {
      // $this->db->select('id', 'ta','nama','bank','jumlah', 'id_murid','id_trx,');
      $query = 'SELECT id_trx FROM tb_transaksi WHERE kode = "SETORAN BSI" AND approve = 0 GROUP BY id_trx';
      $data = $this->db->query($query)->result();
      foreach ($data as $key) {
        $this->db->where('id_trx', $key->id_trx);
        $trx = $this->db->get('tb_transaksi')->row();
        $this->db->where('id_user', $trx->id_murid);
        $user = $this->db->get('tb_user')->row();
        $result[] = [
          'no'    => $no,
          'id'    => $trx->id,
          'ta'    => $trx->ta,
          'date'  => $trx->date_created,
          'id_trx'    => $key->id_trx,
          'penyetor'  => $trx->nama,
          'nama'  => $user->nama,
          'bank'  => $trx->bank,
          'jumlah' => rupiah($trx->total)
        ];
        $no++;
      }
    }
    echo json_encode($result);
  }

  public function getAll($bln, $thn, $hari)
  {
    $no = 1;
    $result = [];
    $this->db->select('id_trx');
    if ($hari != 0) {
      $this->db->where('day(date_created)', $hari);
      $this->db->where('month(date_created)', $bln);
      $this->db->where('year(date_created)', $thn);
    } else {
      $this->db->where('month(date_created)', $bln);
      $this->db->where('year(date_created)', $thn);
    }
    // $data = $this->db->query($query)->result();
    $this->db->group_by('tb_transaksi.id_trx');
    $this->db->where('approve', 1);
    $this->db->where('kode', 'SETORAN BSI');
    $data = $this->db->get('tb_transaksi')->result();

    foreach ($data as $key) {
      $this->db->where('id_trx', $key->id_trx);
      $trx = $this->db->get('tb_transaksi')->result();
      // var_dump($trx[6]);die;
      $this->db->where('id_user', $trx[0]->id_murid);
      $user = $this->db->get('tb_user')->row();
      $result[] = [
        'no'    => $no,
        'id'    => $trx[0]->id,
        'ta'    => $trx[0]->ta,
        'date'  => $trx[0]->date_created,
        'id_trx'    => $key->id_trx,
        'penyetor'  => $trx[0]->nama,
        'nama'  => $user->nama,
        'kelas'  => $trx[0]->kelas,
        'bank'  => $trx[0]->bank,
        'spp' => rupiah($trx[0]->jumlah),
        'gedung' => rupiah($trx[1]->jumlah),
        'kegiatan' => rupiah($trx[2]->jumlah),
        'seragam' => rupiah($trx[3]->jumlah),
        'komite' => rupiah($trx[4]->jumlah),
        'buku' => rupiah($trx[6]->jumlah),
        'sarpras' => rupiah($trx[6]->jumlah),
        'formulir' => rupiah($trx[7]->jumlah),
        'total' => rupiah($trx[0]->total),
      ];
      $no++;
    }

    echo json_encode($result);
  }

  public function harian()
  {
    $this->db->where('approve', 1);
    $this->db->where('kode', 'PEMASUKAN KAS');
    $data = $this->db->get('tb_transaksi')->result();
    if ($data == null) {
      $result = [];
    }
    $no = 1;
    $saldo = 0;
    foreach ($data as $key) {
      if ($key->kredit == 0) {
        $saldo = $saldo + $key->jumlah;
      }
      $this->db->where('kode_akun', $key->akun_kas);
      $kas = $this->db->get('tb_rab')->row();
      $this->db->where('id_sumber', $key->metode);
      $metode = $this->db->get('tb_metode')->row();
      $this->db->where('kode_akun', $key->akun_trx);
      $akun = $this->db->get('tb_rab')->row();
      $result[] = [
        'id'    => $key->id,
        'no'    => $no,
        'date'  => $key->date_created,
        'id_trx'    => $key->id_trx,
        'nama'  => $akun->nama,
        'kas'  => $kas->nama,
        'metode'  => $metode->nama,
        'jumlah' => rupiah($key->jumlah),
        'ket'   => $key->ket,
        'saldo' => rupiah($saldo)
      ];
      $no++;
    }
    echo json_encode($result);
  }

  public function getKode()
  {
    // 13 penasukan bni
    $this->db->order_by('id', 'DESC');
    $data = $this->db->get('tb_transaksi')->result();

    $id_trx = $data[0]->id_trx;
    $id_trx = substr($id_trx, 0, -9);
    $id_trx = (int)$id_trx + 1;
    $id_trx = $id_trx . '.' . date('Ymd') . '13' . $this->session->userdata('id');

    $result = [
      'id_trx' => $id_trx
    ];
    echo json_encode($result);
  }

  public function export($bln, $thn, $id = 'excel', $hari = 0)
  {
    $spreadsheet = new Spreadsheet();
    $excel = $spreadsheet->getActiveSheet();
    $nama_bln = strtoupper(bulan($bln)) . ' ' . $thn;

    $excel->setCellValue('A1', "LAPORAN REKAP SETORAN BSI");
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
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
        'allBorders' => [
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
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      ],
      'borders' => [
        'allBorders' => [
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
      ]
    );

    $excel->mergeCells('A1:P1');
    $excel->mergeCells('A2:P2');
    $excel->mergeCells('A3:P3');
    $excel->mergeCells('A5:A6');
    $excel->mergeCells('B5:B6');
    $excel->mergeCells('C5:C6');
    $excel->mergeCells('D5:D6');
    $excel->mergeCells('E5:E6');
    $excel->mergeCells('F5:F6');
    $excel->mergeCells('G5:G6');
    $excel->mergeCells('P5:P6');
    $excel->mergeCells('H5:O5');
    $excel->getStyle('A1')->getFont()->setBold(TRUE);
    $excel->getStyle('A2')->getFont()->setBold(TRUE);
    $excel->getStyle('A3')->getFont()->setBold(TRUE); 
    $excel->getStyle('A1')->getFont()->setSize(15); 

    $center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;

    $excel->getStyle('A1')->getAlignment()->setHorizontal($center);
    $excel->getStyle('A2')->getAlignment()->setHorizontal($center);
    $excel->getStyle('A3')->getAlignment()->setHorizontal($center);
    //format dalam excel nantinya
    $excel->setCellValue('A5', "No.");
    $excel->setCellValue('B5', "Tanggal");
    $excel->setCellValue('C5', "Th. Ajaran");
    $excel->setCellValue('D5', "Bank");
    $excel->setCellValue('E5', "Penyetor");
    $excel->setCellValue('F5', "Nama Siswa");
    $excel->setCellValue('G5', "Kelas");
    $excel->setCellValue('H5', "Rincian Transfer");
    $excel->setCellValue('H6', "SPP");
    $excel->setCellValue('I6', "Infaq Gedung");
    $excel->setCellValue('J6', "Kegiatan");
    $excel->setCellValue('K6', "Seragam");
    $excel->setCellValue('L6', "Komite");
    $excel->setCellValue('M6', "Buku");
    $excel->setCellValue('N6', "Sarpras");
    $excel->setCellValue('O6', "Formulir");
    $excel->setCellValue('P5', "Total");

    $excel->getStyle('A5:P6')->applyFromArray($style_col);
    $border = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;

    if ($this->scm->cekSecurity() == true) {
      $no = 1;
      $result = [];
      $this->db->select('id_trx');
      if ($hari != 0) {
        $this->db->where('day(date_created)', $hari);
        $this->db->where('month(date_created)', $bln);
        $this->db->where('year(date_created)', $thn);
      } else {
        $this->db->where('month(date_created)', $bln);
        $this->db->where('year(date_created)', $thn);
      }
      
      $this->db->group_by('tb_transaksi.id_trx');
      $this->db->where('approve', 1);
      $this->db->where('kode', 'SETORAN BSI');
      $data = $this->db->get('tb_transaksi')->result();

      foreach ($data as $key) {
        $this->db->where('id_trx', $key->id_trx);
        $trx = $this->db->get('tb_transaksi')->result();
        
        $this->db->where('id_user', $trx[0]->id_murid);
        $user = $this->db->get('tb_user')->row();
        $result[] = [
          'no'    => $no,
          'date'  => $trx[0]->date_created,
          'ta'    => $trx[0]->ta,
          'bank'  => $trx[0]->bank, 
          'penyetor'  => $trx[0]->nama,
          'nama'  => $user->nama,
          'kelas'  => $trx[0]->kelas,
          'spp' => ($trx[0]->jumlah),
          'gedung' => ($trx[1]->jumlah),
          'kegiatan' => ($trx[2]->jumlah),
          'seragam' => ($trx[3]->jumlah),
          'komite' => ($trx[4]->jumlah),
          'buku' => ($trx[6]->jumlah),
          'sarpras' => ($trx[6]->jumlah),
          'formulir' => ($trx[7]->jumlah),
          'total' => ($trx[0]->total),
        ];
        $no++;
      }
    }

    $m = 7;
    if ($result) {
      foreach ($result as $res) {
        $excel->setCellValue('A' . $m, $res['no']);
        $excel->setCellValue('B' . $m, $res['date']);
        $excel->setCellValue('C' . $m, $res['ta']);
        $excel->setCellValue('D' . $m, $res['bank']);
        $excel->setCellValue('E' . $m, $res['penyetor']);
        $excel->setCellValue('F' . $m, $res['nama']);
        $excel->setCellValue('G' . $m, $res['kelas']);
        $excel->setCellValue('H' . $m, $res['spp']);
        $excel->setCellValue('I' . $m, $res['gedung']);
        $excel->setCellValue('J' . $m, $res['kegiatan']);
        $excel->setCellValue('K' . $m, $res['seragam']);
        $excel->setCellValue('L' . $m, $res['komite']);
        $excel->setCellValue('M' . $m, $res['buku']);
        $excel->setCellValue('N' . $m, $res['sarpras']);
        $excel->setCellValue('O' . $m, $res['formulir']);
        $excel->setCellValue('P' . $m, $res['total']);
        $excel->getStyle('A'.$m.':P'. $m)->applyFromArray($style_row);
        $excel->getStyle('H' . $m)->applyFromArray($style_number);
        $excel->getStyle('I' . $m)->applyFromArray($style_number);
        $excel->getStyle('J' . $m)->applyFromArray($style_number);
        $excel->getStyle('K' . $m)->applyFromArray($style_number);
        $excel->getStyle('L' . $m)->applyFromArray($style_number);
        $excel->getStyle('M' . $m)->applyFromArray($style_number);
        $excel->getStyle('N' . $m)->applyFromArray($style_number);
        $excel->getStyle('O' . $m)->applyFromArray($style_number);
        $excel->getStyle('P' . $m)->applyFromArray($style_number);
        $m++;
      }
    }

    $excel->getColumnDimension('A')->setWidth(5); 
    $excel->getColumnDimension('B')->setWidth(20);
    $excel->getColumnDimension('C')->setWidth(15);
    $excel->getColumnDimension('D')->setWidth(10);
    $excel->getColumnDimension('E')->setWidth(20);
    $excel->getColumnDimension('F')->setWidth(30);
    $excel->getColumnDimension('G')->setWidth(30);
    $excel->getColumnDimension('H')->setWidth(15);
    $excel->getColumnDimension('I')->setWidth(15);
    $excel->getColumnDimension('J')->setWidth(15);
    $excel->getColumnDimension('K')->setWidth(15);
    $excel->getColumnDimension('L')->setWidth(15);
    $excel->getColumnDimension('M')->setWidth(15);
    $excel->getColumnDimension('N')->setWidth(15);
    $excel->getColumnDimension('O')->setWidth(15);
    $excel->getColumnDimension('P')->setWidth(15);

    $excel->getDefaultRowDimension()->setRowHeight(-1);

    $filepath = 'Laporan Rekap Setoran BSI ' . $nama_bln;
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


/* End of file Pemasukan.php */
/* Location: ./application/controllers/Pemasukan.php */
