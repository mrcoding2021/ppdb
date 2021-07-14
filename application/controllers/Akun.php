<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Akun extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Model_global', 'M_global');
    $this->load->helper('tgl_indo');
    $this->load->helper('rupiah');
    $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
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
      $data['title'] = $data['judul'];
      $data['admin'] = $this->db->query($query)->result_array();
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $this->db->order_by('id_paket', 'DESC');
      $data['produk'] = $this->db->get('paket')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();

      $this->load->view('admin/header', $data);
      $this->load->view('admin/setting/' . $data['view'], $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('home');
    }
  }


  public function index()
  {
    $data = array(
      'judul' => 'Akun Perkiraan',
      'view'  => 'v_kodeAkun'
    );
    $this->db->where('kategori', 1);
    $this->db->where('is_active', 1);
    $this->db->where('parent', '1');
    $data['akunPemasukan'] = $this->db->get('tb_rab')->result();

    $this->db->where('parent', '2');
    $this->db->where('kategori', 2);
    $this->db->where('is_active', 1);
    $data['akunPengeluaran'] = $this->db->get('tb_rab')->result();

    $this->core($data);
  }

  public function kas()
  {
    $data = array(
      'judul' => 'Akun Kas',
      'view'  => 'akunKas'
    );
    $this->db->where('parent', 0);
    $this->db->where('kategori', 3);
    $this->db->where('is_active', 1);
    $data['akunKas'] = $this->db->get('tb_rab')->result();

    $this->core($data);
  }

  public function getAkunKas()
  {

    $this->db->where('parent', 0);
    $this->db->where('kategori', 3);
    $this->db->where('is_active', 1);
    $akunKas = $this->db->get('tb_rab')->result();
    $data = [];
    foreach ($akunKas as $key) {
      $data[] = [
        'id' => $key->id,
        'kode_akun' => $key->kode_akun,
        'nama' => $key->nama,
        'jumlah' => rupiah($key->jumlah),
        'ta' => $key->ta,
        'alias' => $key->alias,
      ];
    }

    echo json_encode($data);
  }

  public function get($id = 0)
  {
    $this->db->where('id', $id);
    $result = $this->db->get('tb_rab')->row();

    echo json_encode($result);
  }

  public function add()
  {
    $id = $_POST['id'];
    if ($_POST['kategori'] == 1) {
      $parent = htmlspecialchars($this->input->post('parent'));
    } elseif ($_POST['kategori'] == 2) {
      $parent = htmlspecialchars($this->input->post('ortu'));
    } else {
      $parent = 0;
    }

    if ($id) {
      $data = array(
        'kode_akun'     => htmlspecialchars($this->input->post('kode_akun')),
        'nama'     => htmlspecialchars($this->input->post('nama')),
        'kategori'     => htmlspecialchars($this->input->post('kategori')),
        'parent'     => $parent,
        'jumlah'     => $this->input->post('saldo'),
      );

      $this->db->where('id', $id);
      $this->db->update('tb_rab', $data);
      $msg = array('sukses' => 'Success');
    } else {
      $this->db->where('kode_akun', $_POST['kode_akun']);
      $data = $this->db->get('tb_rab')->row();

      if ($_POST['kode_akun'] != $data->kode_akun) {
        $data = array(
          'created_at'    => date('Y-m-d'),
          'kode_akun'     => htmlspecialchars($this->input->post('kode_akun')),
          'nama'     => htmlspecialchars($this->input->post('nama')),
          'kategori'     => htmlspecialchars($this->input->post('kategori')),
          'jumlah'     => $this->input->post('saldo'),
          'parent'     => $parent,
        );
        $this->db->insert('tb_rab', $data);
        $msg = array('sukses' => 'Success');
      } else {
        $msg = array('error' => 'Kode Akun Sudah terdaftar, buat kode akun lain');
      }
    }

    echo json_encode($msg);
  }

  public function addAkunKas()
  {
    $this->db->where('kode_akun', $_POST['kode_akun']);
    $data = $this->db->get('tb_rab')->row();
    if ($_POST['kode_akun'] != $data->kode_akun) {
      $data = array(
        // 'ta'    => $_POST['ta'],
        'created_at'    => date('Y-m-d'),
        // 'kode_akun'     => htmlspecialchars($this->input->post('kode_akun')),
        // 'nama'     => htmlspecialchars(strtoupper($this->input->post('nama'))),
        // 'alias'       => htmlspecialchars($this->input->post('ket')),
        // 'kategori'     => 3,
        // 'jumlah'     => $this->input->post('saldo'),
        // 'parent'     => 0,
      );

      $this->db->insert('tb_rab', $data);
      if ($this->db->affected_rows() > 0) {
        $msg = array('sukses' => 'Success');
      } else {
        $msg = array('error' => 'Gagal ditambah');
      }
    } else {
      $msg = array('error' => 'Kode Akun Sudah terdaftar, buat kode akun lain');
    }

    echo json_encode($msg);
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->set('is_active', 0);
    $this->db->update('tb_rab');
    $msg = array('sukses' => 'Success');

    echo json_encode($msg);
  }

  public function edit($id)
  {

    $data = array(
      'kode_akun' => $_POST['kode_akun'],
      'nama'      => $_POST['nama'],
      'kategori'    => $_POST['kategori'],
      'parent'    => ($_POST['kategori'] == 1) ? $_POST['parent'] : $_POST['ortu']
    );
    $this->db->where('id', $id);
    $this->db->update('tb_rab', $data);

    if ($this->db->affected_rows() > 0) {
      $result = array('sukses' => "Data berhasil di edit");
    } else {
      $result = array('error' => "Data gagal di edit");
    }
    echo json_encode($result);
  }

  public function upload()
  {
    $fileName = $this->input->post('file');
    // var_dump($fileName);die;
    $config['upload_path'] = './asset/upload/';
    $config['file_name'] = $fileName;
    $config['allowed_types'] = 'xls|xlsx';
    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if (!$this->upload->do_upload('file')) {
      $error = array('error' => $this->upload->display_errors());
      $this->session->set_flashdata('alert', '<div class="alert alert-danger">' + $error['error'] + '</div>');
      redirect('akun');
    } else {
      $media = $this->upload->data();
      $inputFileName = 'asset/upload/' . $media['file_name'];
      try {
        $inputFileType = IOFactory::identify($inputFileName);
        $objReader = IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
      } catch (Exception $e) {
        die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
      }
      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      for ($row = 2; $row <= $highestRow; $row++) {
        $rowData = $sheet->rangeToArray(
          'A' . $row . ':' . $highestColumn . $row,
          NULL,
          TRUE,
          FALSE
        );

        $data = array(
          "created_at" => date('Y-m-d'),
          "kode_akun" => $rowData[0][0],
          "nama" => $rowData[0][1],
          'kategori' => $rowData[0][2],
          "parent" => $rowData[0][3],
          "id" => $rowData[0][4],
        );

        $this->db->insert('tb_rab', $data);
      }

      $this->session->set_flashdata('alert', '<div class="alert alert-info">Upload Data pembayaran berhasiil ditambahan</div>');

      redirect('akun');
    }
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
