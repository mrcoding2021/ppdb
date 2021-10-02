<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Import extends CI_Controller

{

    function __construct()

    {

        parent::__construct();

        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));

        $this->load->helper('rupiah');
    }



    public function index()

    {

        $this->load->view('v_import');
    }



    public function upload()

    {

        $fileName = $this->input->post('file');



        $config['upload_path'] = './asset/upload/';

        $config['file_name'] = $fileName;

        $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';

        $config['max_size'] = 10000;



        $this->load->library('upload', $config);

        $this->upload->initialize($config);



        if (!$this->upload->do_upload('file')) {

            $error = array('error' => $this->upload->display_errors());

            $this->session->set_flashdata('alert', '<div class="alert alert-danger">Upload data produk gagal ditambahan</div>');

            redirect('sipajar');
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

                    "nis" => $rowData[0][0],

                    "nama" => $rowData[0][1],

                    "pj" => $rowData[0][2],

                    "email" => $rowData[0][3],

                    "hp" => $rowData[0][4],

                    "password" => str_replace('-', '', $rowData[0][5]),

                    "level" => $rowData[0][6],

                    "parent" => $rowData[0][7],

                    "pwd" => $rowData[0][9],

                    "date_created" => date('Y-m-d'),

                );

                $this->db->insert('tb_user', $data);
            }

            $this->session->set_flashdata('alert', '<div class="alert alert-info">Upload Data murid berhasiil ditambahan</div>');

            redirect('sipajar/saldo');
        }
    }



    public function uploadUser()

    {

        $fileName = $this->input->post('file');



        $config['upload_path'] = './asset/upload/';

        $config['file_name'] = $fileName;

        $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';

        $config['max_size'] = 10000;



        $this->load->library('upload', $config);

        $this->upload->initialize($config);



        if (!$this->upload->do_upload('file')) {

            $error = array('error' => $this->upload->display_errors());

            $this->session->set_flashdata('alert', '<div class="alert alert-danger">Upload data produk gagal ditambahan</div>');

            redirect('produk');
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

                    "id_user" => $rowData[0][0],

                    "nama" => $rowData[0][2],

                    "hp" => $rowData[0][3],

                );

                $this->db->insert('tb_user', $data);
            }

            $this->session->set_flashdata('alert', '<div class="alert alert-info">Upload Data produk berhasiil ditambahan</div>');

            redirect('user');
        }
    }



    public function uploadMutasi()

    {

        $fileName = $this->input->post('file');



        $config['upload_path'] = './asset/upload/';

        $config['file_name'] = $fileName;

        $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';

        $config['max_size'] = 10000;



        $this->load->library('upload', $config);

        $this->upload->initialize($config);



        if (!$this->upload->do_upload('file')) {

            $error = array('error' => $this->upload->display_errors());

            $this->session->set_flashdata('alert', '<div class="alert alert-danger">Upload data produk gagal ditambahan</div>');

            redirect('sipajar/mutasi');
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

                    "id_murid" => $rowData[0][0],

                    "id_sekolah" => $rowData[0][1],

                    "keterangan" => $rowData[0][2],

                    "debit" => $rowData[0][3],

                    'kredit' => $rowData[0][4],

                    'date_created' => $rowData[0][5]


                );

                $this->db->insert('tb_tansaksi', $data);
            }

            $this->session->set_flashdata('alert', '<div class="alert alert-info">Upload Data produk berhasiil ditambahan</div>');

            redirect('sipajar/mutasi');
        }
    }

    public function pembayaran()
    {
        $fileName = $this->input->post('file');
        $config['upload_path'] = './asset/upload/';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
        $config['max_size'] = 10000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('alert', '<div class="alert alert-danger">Upload data produk gagal ditambahan</div>');
            redirect('sipajar/mutasi');
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
                if ($rowData[0][5] == NULL) {
                    $kredit = 0;
                    $tagihan = 0;
                } else {
                    $kredit = $rowData[0][5];
                    $tagihan = $rowData[0][4];
                }
                $data = array(
                    "date_created" => "2021-01-01 " . date('H:i:s'),
                    "akun_kas"  => '0-10001',
                    "id_trx" => $rowData[0][0],
                    "id_murid" => $rowData[0][1],
                    "tagihan" => $tagihan,
                    "kategori" => 1,
                    'kode' => $rowData[0][3],
                    'metode' => 1,
                    'kredit' => $kredit,
                    'jumlah' => $kredit,
                    "akun_trx" => $rowData[0][6],
                    'ta' => $rowData[0][7],
                );

                $this->db->insert('tb_transaksi', $data);
            }

            $this->session->set_flashdata('alert', '<div class="alert alert-info">Upload Data pembayaran berhasiil ditambahan</div>');

            redirect('pembayaran');
        }
    }
}





/* End of file Menu.php */

/* Location: ./application/controllers/Menu.php */
