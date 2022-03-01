<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('tgl_indo');
        $this->load->model('Model_global', 'mapp');
        $this->load->helper('rupiah');
        $this->load->library('form_validation');
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
            $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
            $data['users'] = $this->db->get_where($table, array('level' => 3, 'is_active' => 1))->result();
            $data['sekolah'] = $this->db->get('tb_sekolah')->result();
            // $data['transaksi'] = $this->mapp->get_all('tb_tansaksi');
            $this->load->view('admin/header', $data);
            $this->load->view($data['view'], $data);
            $this->load->view('admin/footer', $data);
        } else {
            redirect('adm');
        }
    }

    public function index()
    {
        $data = [
            'parent'        => 'Data',
            'title'         => 'Data Siswa',
            'view'          => 'admin/v_data',
        ];
        $this->core($data);
    }

    public function guru()
    {
        $data = [
            'parent'        => 'Data',
            'title'         => 'Data Guru',
            'view'          => 'admin/v_guru',
        ];
        $this->core($data);
    }

    public function mutasi()
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

            $data['title'] = 'Mutasi';
            $data['admin'] = $this->db->query($query)->result_array();
            $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
            $data['sekolah'] = $this->db->get('tb_sekolah')->result();
            $data['transaksi'] = $this->mapp->get_all('tb_tansaksi');
            $this->load->view('admin/header', $data);
            if ($level == 1) {
                $this->load->view('admin/v_mutasi', $data);
            } elseif ($level == 2) {
                $data['sekolah'] = $this->mapp->get_by('tb_user', array('id_user' => $id));
                $this->db->where('id_sekolah', $data['sekolah']->id_user);
                $data['transaksi_murid'] = $this->db->get('tb_tansaksi')->result();
                $this->load->view('admin/v_mutasi_sekolah', $data);
            } else {
                $this->load->view('admin/v_mutasi_murlid', $data);
            }
            $this->load->view('admin/footer', $data);
        } else {
            redirect('home');
        }
    }

    public function saldo()
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

            $data['title'] = 'Data';
            $data['admin'] = $this->db->query($query)->result_array();
            $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
            $data['sekolah'] = $this->db->get('tb_sekolah')->result();
            $data['transaksi'] = $this->mapp->get_all('tb_tansaksi');
            $this->load->view('admin/header', $data);
            if ($level == 1) {
                $this->load->view('admin/v_saldo_sekolah', $data);
            } else {
                $data['sekolah'] = $this->mapp->get_by('tb_user', array('id_user' => $id));
                $this->db->where('id_sekolah', $data['sekolah']->id_user);
                $data['pelajar_sekolah'] = $this->db->get('tb_murid')->result();

                $this->load->view('admin/v_saldo_murid', $data);
            }

            $this->load->view('admin/footer', $data);
        } else {
            redirect('home');
        }
    }

    public function addSekolah()
    {
        if ($this->scm->cekSecurity() == true) {
            $this->form_validation->set_rules('nama', 'Judul Post', 'trim|required');
            $this->form_validation->set_rules('hp', 'No. HP Sekolah', 'trim|required');

            $shuffle = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffle = substr(str_shuffle($shuffle), 0, 8);

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'nama' => $this->input->post('nama'),
                    'email' => $this->input->post('email'),
                    'alamat' => $this->input->post('alamat'),
                    'date_created' => date('Y-m-d'),
                    'hp' => $this->input->post('hp'),
                    'pj' => $this->input->post('pj'),
                    'parent' => 1,
                    'level' => 2,
                    'pwd' => $shuffle,
                    'password' => md5($shuffle)
                );
                $this->db->insert('tb_user', $data);
                $this->session->set_flashdata('alert', '<div class="alert alert-info">Data baru berhasiil dirubah</div>');
                redirect('sipajar/saldo');
            } else {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger">Mohon maaf. data gagal dirubah</div>');
                redirect('sipajar/saldo');
            }
        }
    }

    public function getId()
    {
        if ($this->scm->cekSecurity() == true) {
            $id  = $this->input->post('nama');
            $this->db->where('nama', $id);
            $data = $this->db->get('tb_user')->row();

            if (date('m') > 6) {
                $this->db->where('ta', date('Y') . '-' . (date('Y') + 1));
            } elseif (date('m') < 7) {
                $this->db->where('ta', (date('Y') - 1) . '-' . date('Y'));
            }
            $this->db->where('id_murid', $data->id_user);
            $ajaran = $this->db->get('tb_user_tagihan')->result();

            if ($ajaran) {
                $this->db->where('kode_kelas', $ajaran[0]->kelas);
                $kelas = $this->db->get('tb_user_kelas')->row();
            } else {
                $kelas = '';
            }

            $result = [
                'id_user'       => $data->id_user,
                'nis'       => $data->nis,
                'nisn'       => $data->nisn,
                'wali'       => $data->pj,
                'hp'       => $data->hp,
                'kelas'       => ($kelas != null) ? $kelas->ket . ' - ' . $kelas->nama : $kelas,
                'nama'      => $data->nama
            ];
            echo json_encode($result);
        }
    }

    public function addSiswa()
    {
        if ($this->scm->cekSecurity() == true) {
            $this->form_validation->set_rules('nama', 'Judul Post', 'trim|required');
            $this->form_validation->set_rules('hp', 'No. HP Sekolah', 'trim|required');
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'trim|required');

            $shuffle = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffle = substr(str_shuffle($shuffle), 0, 8);
            $id = $this->input->post('id_user');
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'nama' => strtoupper($this->input->post('nama')),
                    'nis' => $this->input->post('nis'),
                    'nisn' => $this->input->post('nisn'),
                    // 'ta'    => $this->input->post('ta'),
                    'email' => $this->input->post('email'),
                    'alamat' => $this->input->post('alamat'),
                    'tempat_lahir' => $this->input->post('tempat_lahir'),
                    'hp' => $this->input->post('hp'),
                    'pj' => $this->input->post('wali'),
                    'parent' => 12,
                    'level' => 4,
                    'pwd' =>  $this->input->post('tgl_lahir'),
                    'password' => md5(str_replace('-', '', $this->input->post('tgl_lahir')))
                );

                if ($id) {
                    $this->db->where('id_user', $id);
                    $this->db->set('date_created', $this->input->post('date'));
                    $this->db->update('tb_user', $data);
                    $aff = 'Data berhasil dirubah';
                } else {
                    $this->db->set('date_created', $this->input->post('date'));
                    $this->db->insert('tb_user', $data);
                    $aff = 'Data berhasil tersimpan';
                }

                if ($this->db->affected_rows() > 0) {
                    $res = ['sukses' => $aff];
                } else {
                    $res = ['error' => 'Data gagal tersimpan'];
                }
            } else {
                $res = ['error' => validation_errors()];
            }
            echo json_encode($res);
        }
    }

    public function sekolah($id_sekolah)
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

            $data['title'] = 'Sekolah';
            $data['admin'] = $this->db->query($query)->result_array();
            $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();

            $this->db->where('id_user', $id_sekolah);
            $data['sekolah'] = $this->db->get('tb_user')->row();
            $this->db->where('parent', $id_sekolah);
            $data['pelajar'] = $this->db->get('tb_user')->result();
            $data['transaksi'] = $this->mapp->get_all('tb_tansaksi');
            $this->load->view('admin/header', $data);
            $this->load->view('pages/sekolah', $data);
            $this->load->view('admin/footer', $data);
        } else {
            redirect('auth');
        }
    }

    public function profil()
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

            $data['title'] = 'Profil';
            $data['admin'] = $this->db->query($query)->result_array();
            $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();

            $this->db->where('id_user', $id);
            $data['murid'] = $this->db->get('tb_user')->row();
            $this->db->where('id_user', $data['murid']->parent);
            $data['sekolah'] = $this->db->get('tb_user')->row();
            $data['transaksi'] = $this->mapp->get_all('tb_tansaksi');
            $this->load->view('admin/header', $data);
            $this->load->view('pages/profil', $data);
            $this->load->view('admin/footer', $data);
        } else {
            redirect('auth');
        }
    }

    public function addMurid()
    {
        if ($this->scm->cekSecurity() == true) {
            $this->form_validation->set_rules('nama', 'Judul Post', 'trim|required');
            $this->form_validation->set_rules('hp', 'No. HP Sekolah', 'trim|required');
            $this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'trim|required');

            $shuffle = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffle = substr(str_shuffle($shuffle), 0, 8);

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'nama' => $this->input->post('nama'),
                    'email' => $this->input->post('email'),
                    'alamat' => $this->input->post('alamat'),
                    'date_created' => date('Y-m-d'),
                    'hp' => $this->input->post('hp'),
                    'pj' => $this->input->post('pj'),
                    'parent' => 1,
                    'level' => 2,
                    'pwd' => $_POST['tgl_lahir'],
                    'password' => str_replace('-', '', $_POST['tgl_lahir'])
                );
                $this->db->insert('tb_user', $data);
                $this->session->set_flashdata('alert', '<div class="alert alert-info">Data baru berhasiil dirubah</div>');
                redirect('sipajar/saldo');
            } else {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger">Mohon maaf. data gagal dirubah</div>');
                redirect('sipajar/saldo');
            }
        }
    }

    public function nameSchool()
    {
        if ($this->scm->cekSecurity() == true) {
            $id = $_POST['id'];
            $this->db->where('id_user', $id);
            $nama = $this->db->get('tb_user')->row();
            if ($nama) {
                echo json_encode($nama);
            } else {
                $nama = array('nama' => "Tidak ada Sekolah");
                echo json_encode($nama);
            }
        }
    }

    public function dataKelas()
    {
        if ($this->scm->cekSecurity() == true) {
            $this->db->where('is_active', 1);
            $kelas = $this->db->get('tb_user_kelas')->result();
            echo json_encode($kelas);
        }
    }

    public function addKelas()
    {
        if ($this->scm->cekSecurity() == true) {
            $this->form_validation->set_rules('kode_kelas', 'Kode Kelas', 'trim|required');
            $this->form_validation->set_rules('nama', 'Nama Kelas', 'trim|required');

            $id = $this->input->post('id');
            $kd_kelas = $this->input->post('kode_kelas');
            $this->db->where('kode_kelas', strtoupper($kd_kelas));
            $kode_kelas = $this->db->get('tb_user_kelas')->result();
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'kode_kelas' => strtoupper($this->input->post('kode_kelas')),
                    'nama' => strtoupper($this->input->post('nama')),
                    'ket' => $this->input->post('kelas'),
                    'keterangan' => $this->input->post('keterangan'),
                );

                if ($id) {
                    $this->db->where('id', $id);
                    $this->db->update('tb_user_kelas', $data);
                    $aff = 'Data berhasil dirubah';
                    $sandi = 1;
                } else {
                    if ($kode_kelas == null) {
                        $this->db->set('created_at', date('Y-m-d H:i:s'));
                        $this->db->insert('tb_user_kelas', $data);
                        $sandi = 1;
                        $aff = 'Data berhasil tersimpan';
                    } else {
                        $sandi = 0;
                        $aff = 'kode Kelas sudah ada, silahkan rubah!, data gagal terimpan';
                    }
                }

                if ($sandi > 0) {
                    $res = ['sukses' => $aff];
                } else {
                    $res = ['error' => $aff];
                }
            } else {
                $res = ['error' => validation_errors()];
            }
            echo json_encode($res);
        }
    }

    public function hapusKelas($id)
    {
        if ($this->scm->cekSecurity() == true) {
            $ids = $this->session->userdata('id');
            if ($ids) {
                $this->db->where('id', $id);
                $this->db->set('is_active', 0);
                $this->db->update('tb_user_kelas');
                if ($this->db->affected_rows() > 0) {
                    $result = ['sukses' => 'Data berhasil dihapus'];
                } else {
                    $result = ['error' => 'Data gagal dihapus'];
                }
                echo json_encode($result);
            } else {
                redirect('auth');
            }
        }
    }

    public function getGuru()
    {
        $this->db->where('level', 3);
        $data = $this->db->get('tb_user')->result();
        $no = 1;
        foreach ($data as $key) {
            $result[] = [
                'no'            => $no,
                'nama'          => $key->nama,
                'hp'            => $key->hp,
                'alamat'        => $key->alamat,
                'id'            => $key->id_user
            ];
            $no++;
        }
        echo json_encode($result);
    }

    public function export($kode, $id = 'excel')
    {
        $spreadsheet = new Spreadsheet();
        $excel = $spreadsheet->getActiveSheet();
        // $nama_bln = strtoupper(($start) . ' - ' . ($end));

        $excel->setCellValue('A1', "DATA SISWA");
        $excel->setCellValue('A2', "SDIT INSAN MULIA BEKASI");
        // $excel->setCellValue('A3', $nama_bln);

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
        $excel->setCellValue('B5', "NIS/NISN");
        $excel->setCellValue('C5', "Nama Siswa");
        $excel->setCellValue('D5', "Kelas");
        $excel->setCellValue('E5', "Nama Kelas");
        $excel->setCellValue('G5', "L/P");
        $excel->setCellValue('F5', "TA");

        $excel->getStyle('A5')->applyFromArray($style_col);
        $excel->getStyle('B5')->applyFromArray($style_col);
        $excel->getStyle('C5')->applyFromArray($style_col);
        $excel->getStyle('D5')->applyFromArray($style_col);
        $excel->getStyle('E5')->applyFromArray($style_col);
        $excel->getStyle('F5')->applyFromArray($style_col);
        $excel->getStyle('G5')->applyFromArray($style_col);

        $border = \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN;

        if ($this->scm->cekSecurity() == true) {
            $this->db->where('level', 4);
            $data = $this->db->get('tb_user')->result();
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
                'nis'  => $trx[0]->date_created,
                'nama'  => $siswa->nama,
                'kelas' => $trx[0]->kelas,
                'nama_kelas' => $jumlah->total,
                'ta' => $trx[0]->ta,
                'l_p' => $saldo,
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

        $filepath = 'Laporan Pembayaran Siswa ';
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
