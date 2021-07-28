<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

            $data['title'] = 'Data Siswa';
            $data['admin'] = $this->db->query($query)->result_array();
            $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
            $data['users'] = $this->db->get_where($table, array('level' => 3, 'is_active' => 1))->result();
            $data['sekolah'] = $this->db->get('tb_sekolah')->result();
            // $data['transaksi'] = $this->mapp->get_all('tb_tansaksi');
            $this->load->view('admin/header', $data);
            $this->load->view('admin/v_data', $data);
            $this->load->view('admin/footer', $data);
        } else {
            redirect('auth');
        }
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

    public function addSiswa()
    {
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
                'ta'    => $this->input->post('ta'),
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

    public function nameSchool()
    {
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
