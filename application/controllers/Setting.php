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
            $data['siswa'] = $this->db->get_where('tb_user', array('level' => 4, 'is_active' => 1))->result();

            $this->load->view('admin/header', $data);
            $this->load->view('admin/setting/' . $data['page'], $data);
            $this->load->view('admin/footer', $data);
        } else {
            redirect('home');
        }
    }

    public function index()
    {
        $data = [
            'title'         => 'Setting tagihan Siswa',
            'page'          => 'v_setting'
        ];
        $this->core($data);
    }

    public function detailTagihan($id)
    {
        $this->db->select('ta');
        $this->db->group_by('ta');
        $ta = $this->db->get('tb_ta')->result();
        $this->db->where('id_user', $id);
        $nama = $this->db->get('tb_user')->row();


        $data = [
            'title'         => 'Detail Tagihan ' . $nama->nama,
            'page'          => 'detail',
            'ta'            => $ta,
            'id'            => $id,
        ];
        $this->core($data);
    }

    public function getTagihan()
    {
        $id = $this->input->post('id');
        $ta = $this->input->post('ta');
        $this->db->where('ta', $ta);
        $this->db->where('id_murid', $id);
        $tagihan = $this->db->get('tb_user_tagihan')->result();
        echo json_encode($tagihan);
    }

    public function add()
    {

        $this->form_validation->set_rules('ta', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('id_murid', 'Id siswa', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $kode = ['SPP', 'PEMBANGUNAN', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU PAKET', 'SARPRAS'];
            for ($i = 0; $i < 7; $i++) {
                $data = array(
                    'id_murid'      => $this->input->post('id_murid'),
                    'kelas'         => $this->input->post('kelas'),
                    'ta'            => trim(htmlspecialchars($_POST['ta'])),
                    'kode'          => trim(htmlspecialchars($kode[$i])),
                    'bayar'         => trim(htmlspecialchars($this->input->post('bayar')[$i])),
                );
                $this->db->set('created_at', date('Y-m-d H:i:s'));
                $this->db->insert('tb_user_tagihan', $data);
            }
            $aff = 'Data berhasil tersimpan';
            if ($this->db->affected_rows() > 0) {
                $res = ['sukses' => $aff];
            } else {
                $res = ['error' => 'Data gagal ersimpan'];
            }
        } else {
            $res = ['error' => validation_errors()];
        }
        echo json_encode($res);
    }

    public function edit()
    {

        $this->form_validation->set_rules('ta[]', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('id_murid[]', 'Id siswa', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id[]');
            $i = 0;
            for ($i = 0; $i < 7; $i++) {
                $data = array(
                    'kelas'         => $this->input->post('kelas'),
                    'ta'         => $this->input->post('ta'),
                    'bayar'         => $this->input->post('bayar')[$i],
                );
                $this->db->where('id', $id[$i]);
                $this->db->update('tb_user_tagihan', $data);
                $aff = 'Data berhasil dirubah';
            }

            if ($i > 0) {
                $res = ['sukses' => $aff];
            } else {
                $res = ['error' => 'Data gagal tersimpan'];
            }
        } else {
            $res = ['error' => validation_errors()];
        }
        echo json_encode($res);
    }

    public function hapus()
    {

        $this->form_validation->set_rules('ta', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('id', 'Id siswa', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $id = $this->input->post('id');
            $ta = $this->input->post('ta');

            $this->db->where('id_murid', $id);
            $this->db->where('ta', $ta);
            $this->db->delete('tb_user_tagihan');

            $aff = 'Data berhasil dirubah';

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
