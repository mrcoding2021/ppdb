<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
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

            $data['title'] = 'Sistem Setting';
            $data['admin'] = $this->db->query($query)->result_array();
            $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
            $data['setting'] = $this->db->get('tb_setting')->result_array();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/setting/v_setting', $data);
            $this->load->view('admin/footer', $data);
        } else {
            redirect('home');
        }
    }

    public function getAll($id = 0)
    {
        if ($id > 0) {
            $this->db->where('id_user', $id);
            $result = $this->db->get('tb_user')->row();
        } else {
            $this->db->where('level', 4);
            $this->db->where('is_active', 1);
            $data = $this->db->get('tb_user')->result();
            $result = [];
            // var_dump($data);die;
            $no = 1;
            foreach ($data as $key) {
                $this->db->where('id_siswa', $key->id_user);
                $tagihan = $this->db->get('tb_user_tagihan')->row();
                $this->db->where('kode_kelas', $key->kelas);
                $kelas = $this->db->get('tb_user_kelas')->row();
                $result[] = [
                    'no'        => $no++,
                    'id'        => $key->id_user,
                    'nis'        => $key->nis .'<br>'.$key->nisn,
                    'nama'      => $key->nama,
                    'kelas'      => ($kelas != null) ? $kelas->ket . ' - ' . $kelas->nama : '',
                    'ta'      => ($tagihan != null) ? $tagihan->ta : '',
                    'spp'      => ($tagihan != null) ? rupiah($tagihan->spp): 0,
                    'gedung'      => ($tagihan != null) ? rupiah($tagihan->gedung) : 0,
                    'kegiatan'      => ($tagihan != null) ? rupiah($tagihan->kegiatan): 0,
                    'buku'      => ($tagihan != null) ? rupiah($tagihan->buku) : 0,
                    'komite'      => ($tagihan != null) ? rupiah($tagihan->komite) : 0,
                    'seragam'      => ($tagihan != null) ? rupiah($tagihan->seragam) : 0,
                    'sarpras'      => ($tagihan != null) ? rupiah($tagihan->sarpras) : 0,
                ];
            }
        }
        echo json_encode($result);
    }

    public function add()
    {

        $this->form_validation->set_rules('ta', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('kode_kelas', 'Kode kelas', 'trim|required');

        $id = $this->input->post('id');
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'ta'  => trim(htmlspecialchars($_POST['ta'])),
                'nama'  => trim(htmlspecialchars($_POST['nama'])),
                'ket'  => trim(htmlspecialchars($_POST['ket'])),
                'kode_kelas'  => trim(htmlspecialchars($_POST['kode_kelas'])),
                'gedung'  => trim(htmlspecialchars($_POST['gedung'])),
                'kegiatan'  => trim(htmlspecialchars($_POST['kegiatan'])),
                'seragam'  => trim(htmlspecialchars($_POST['seragam'])),
                'komite'  => trim(htmlspecialchars($_POST['komite'])),
                'buku'  => trim(htmlspecialchars($_POST['buku'])),
                'spp'  => trim(htmlspecialchars($_POST['spp'])),
                'sarpras'  => trim(htmlspecialchars($_POST['sarpras'])),
            );

            if ($id) {
                $this->db->where('id', $id);
                $this->db->update('tb_user_kelas', $data);
                $aff = 'Data berhasil dirubah';
            } else {
                $this->db->set('created_at', date('Y-m-d'));
                $this->db->insert('tb_user_kelas', $data);
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
