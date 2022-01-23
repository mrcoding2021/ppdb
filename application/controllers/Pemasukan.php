<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

class Pemasukan extends CI_Controller
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
      
      $data['metode'] = $this->db->get('tb_metode')->result();
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
      'title'   => 'Pemasukan Kas',
      'view'    => 'transaksi/pemasukan',
      'kas'     => $kas
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
      'inputer'         => $this->session->userdata('id'),
      'nama'            => htmlspecialchars(strtoupper($this->input->post('nama'))),
      'id_trx'          => htmlspecialchars($this->input->post('id_trx')),
      'kode'            => 'PEMASUKAN KAS',
      'akun_kas'        => $this->input->post('akun_kas'),
      'akun_trx'        => $this->input->post('akun_kas'),
      'ta'              => ($this->input->post('ta')),
      'kategori'        => 1,
      'metode'          => ($this->input->post('metode')),
      'debit'           => ($kategori == 0) ? $nilai : 0,
      'kredit'          => ($kategori == 1) ? $nilai : 0,
      'jumlah'          => $nilai,
      'ket'             => $this->input->post('ket'),
      'approve'         => 1,
    );

    if ($this->form_validation->run() == TRUE) {
      $id = $this->input->post('id');
      if ($id) {
        $this->db->where('id', $id);
        $this->db->update('tb_transaksi', $data);
        $msg = 'Dada berhasil dirubah';
      } else {
        $this->db->set('date_created', $this->input->post('date') . ' ' . date('H:i:s'));
        $this->db->set('date', $this->input->post('date'));
        $this->db->set('time', date('H:i:s'));
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
      $this->db->where('kode', 'PEMASUKAN KAS');
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

  public function harian($start, $end)
  {
    $this->db->order_by('date_created', 'asc');
    $start = explode('-', $start);
    $end = explode('-', $end);
    if ($start != 0) {
      $this->db->where('day(date_created) >=', $start[2]);
      $this->db->where('month(date_created) >=', $start[1]);
      $this->db->where('year(date_created) >=', $start[0]);
      $this->db->where('day(date_created) <=', $end[2]);
      $this->db->where('month(date_created) <=', $end[1]);
      $this->db->where('year(date_created) <=', $end[0]);
    }
    $this->db->where('approve', 1);
    $this->db->where_not_in('kode', 'TABUNGAN');
    // $this->db->where('kategori', 1);
    $this->db->where('kode', 'PEMASUKAN KAS');
    $data = $this->db->get('tb_transaksi')->result();
    if ($data == null) {
      $result = [];
    }
    $no = 1;
    $saldo = 0;
    foreach ($data as $key) {
      if ($key->kredit > 0) {
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
        'nama'  => $key->nama,
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
    // 1 penasukan
    $this->db->order_by('id', 'DESC');
    $data = $this->db->get('tb_transaksi')->result();

    $id_trx = $data[0]->id_trx;
    $id_trx = substr($id_trx, 0, -9);
    $id_trx = (int)$id_trx + 1;
    $id_trx = $id_trx . '.' . date('Ymd') . '1' . $this->session->userdata('id');

    $result = [
      'id_trx' => $id_trx
    ];
    echo json_encode($result);
  }

  public function export($start, $end, $id = 'excel')
  {
    $spreadsheet = new Spreadsheet();
    $excel = $spreadsheet->getActiveSheet();
    $nama_bln = strtoupper(($start) . ' - ' . ($end));

    $excel->setCellValue('A1', "LAPORAN PEMASUKAN KAS");
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
    $excel->setCellValue('C5', "Diterima Dari"); // Set kolom C5 dengan tulisan "NAMA"
    $excel->setCellValue('D5', "Ke Kas"); // Set kolom D5 dengan tulisan "JENIS KELAMIN"
    $excel->setCellValue('E5', "Metode");
    $excel->setCellValue('F5', "Nilai");
    $excel->setCellValue('G5', "Ket");

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
      $start = explode('-', $start);
      $end = explode('-', $end);
      if ($start != 0) {
        $this->db->where('day(date_created) >=', $start[2]);
        $this->db->where('month(date_created) >=', $start[1]);
        $this->db->where('year(date_created) >=', $start[0]);
        $this->db->where('day(date_created) <=', $end[2]);
        $this->db->where('month(date_created) <=', $end[1]);
        $this->db->where('year(date_created) <=', $end[0]);
      }
      $this->db->where('approve', 1);
      $this->db->where_not_in('kode', 'TABUNGAN');
      $this->db->where('kode', 'PEMASUKAN KAS');
      $data = $this->db->get('tb_transaksi')->result();
    }
    $saldo = 0;
    $no = 1;
    foreach ($data as $key) {

      if ($key->kredit > 0) {
        $saldo = $saldo + $key->jumlah;
      }
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
        'jumlah' => $key->jumlah,
        'ket'   => $key->ket,
        'saldo' => rupiah($saldo)
      ];
      $no++;
    }

    $m = 6;
    if ($result) {
      foreach ($result as $res) {
        $excel->setCellValue('A' . $m, $res['no']);
        $excel->setCellValue('B' . $m, shortdate_indo(substr($res['date'],0,10)));
        $excel->setCellValue('C' . $m, $res['nama']);
        $excel->setCellValue('D' . $m, $res['kas']);
        $excel->setCellValue('E' . $m, $res['metode']);
        $excel->setCellValue('F' . $m, $res['jumlah']);
        $excel->setCellValue('G' . $m, $res['ket']);

        $excel->getStyle('A' . $m)->applyFromArray($style_row);
        $excel->getStyle('B' . $m)->applyFromArray($style_row);
        $excel->getStyle('C' . $m)->getBorders()->getOutline()->setBorderStyle($border);
        $excel->getStyle('D' . $m)->getBorders()->getOutline()->setBorderStyle($border);
        $excel->getStyle('E' . $m)->applyFromArray($style_row);
        $excel->getStyle('F' . $m)->applyFromArray($style_number);
        $excel->getStyle('G' . $m)->applyFromArray($style_row);

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

    $filepath = 'Laporan Pemasukan KAS ' . $nama_bln;
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
