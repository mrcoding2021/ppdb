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
        $ta = '2017-2018';

        if ($id > 0) {
            $this->db->where('id_user', $id);
            $data = $this->db->get('tb_user')->row();
            $this->db->where('id_siswa', $data->id_user);
            $this->db->where('ta', $ta);
            $tagihan = $this->db->get('tb_user_tagihan')->result();
            // var_dump($tagihan);die;
            $this->db->where('kode_kelas', $data->kelas);
            $kelas = $this->db->get('tb_user_kelas')->row();
            $result = [
                'id'        => $data->id_user,
                'nis'        => $data->nis . '<br>' . $data->nisn,
                'nama'      => $data->nama,
                'kelas'      => ($kelas != null) ? $kelas->ket . ' - ' . $kelas->nama : '',
                'ta'      => $ta,
                'spp'      => ($tagihan != null) ? rupiah($tagihan[0]->total) : 0,
                'gedung'      => ($tagihan != null) ? rupiah($tagihan[1]->total) : 0,
                'kegiatan'      => ($tagihan != null) ? rupiah($tagihan[2]->total) : 0,
                'buku'      => ($tagihan != null) ? rupiah($tagihan[3]->total) : 0,
                'komite'      => ($tagihan != null) ? rupiah($tagihan[4]->total) : 0,
                'seragam'      => ($tagihan != null) ? rupiah($tagihan[5]->total) : 0,
                'sarpras'      => ($tagihan != null) ? rupiah($tagihan[6]->total) : 0,
            ];
        } else {
            $this->db->where('level', 4);
            $this->db->where('is_active', 1);
            $data = $this->db->get('tb_user')->result();
            $result = [];
            // var_dump($data);die;
            $no = 1;
            foreach ($data as $key) {
                $this->db->where('id_siswa', $key->id_user);
                $tab = $this->db->get('tb_user_tagihan')->row();

                $this->db->where('kode_kelas', $key->kelas);
                $kelas = $this->db->get('tb_user_kelas')->row();

                $tagihan = [];
                $kode = ['SPP', 'INFAQ GEDUNG', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU', 'SARPRAS'];
                for ($i = 0; $i < 7; $i++) {
                    $this->db->where('kode', $kode[$i]);
                    $this->db->where('id_siswa', $key->id_user);
                    $this->db->where('ta', $ta);
                    $tagihan[] = $this->db->get('tb_user_tagihan')->row();           
                }
        
                $result[] = [
                    'no'        => $no++,
                    'id'        => $key->id_user,
                    'nis'        => $key->nis . '<br>' . $key->nisn,
                    'nama'      => $key->nama,
                    'kelas'      => ($kelas != null) ? $kelas->ket . ' - ' . $kelas->nama : '',
                    'ta'      => ($tab != null) ? $tab->ta : '',
                    'spp'      => ($tagihan[0] != null) ? rupiah($tagihan[0]->total) : 0,
                    'gedung'      => ($tagihan[1] != null) ? rupiah($tagihan[1]->total) : 0,
                    'kegiatan'      => ($tagihan[2] != null) ? rupiah($tagihan[2]->total) : 0,
                    'buku'      => ($tagihan[3] != null) ? rupiah($tagihan[3]->total) : 0,
                    'komite'      => ($tagihan[4] != null) ? rupiah($tagihan[4]->total) : 0,
                    'seragam'      => ($tagihan[5] != null) ? rupiah($tagihan[5]->total) : 0,
                    'sarpras'      => ($tagihan[6] != null) ? rupiah($tagihan[6]->total) : 0,
                ];
            }
        }
        echo json_encode($result);
    }

    public function add()
    {

        $this->form_validation->set_rules('ta', 'Tahun Ajaran', 'trim|required');
        $this->form_validation->set_rules('id_siswa', 'Id siswa', 'trim|required');

        $id = $this->input->post('id');
        if ($this->form_validation->run() == TRUE) {
            $kode = ['SPP', 'INFAQ GEDUNG', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU', 'SARPRAS'];
            if ($id) {
                for ($i = 0; $i < 7; $i++) {
                    $data = array(
                        'ta'            => trim(htmlspecialchars($_POST['ta'])),
                        'ta_lalu'       => trim(htmlspecialchars($_POST['ta_lalu'])),
                        'kode'          => trim(htmlspecialchars($kode[$i])),
                        'bayar'         => trim(htmlspecialchars($_POST['bayar'][$i])),
                        'bayar_lalu'    => trim(htmlspecialchars($_POST['bayar_lalu'][$i])),
                        'total'    => trim(htmlspecialchars($_POST['total'][$i])),
                        'ket'           => trim(htmlspecialchars($_POST['ket'][$i])),
                    );
                }
                $this->db->where('id', $id);
                $this->db->set('updated_at', date('Y-m-d H:i:s'));
                $this->db->update('tb_user_tagihan', $data);
                $aff = 'Data berhasil dirubah';
            } else {
                for ($i = 0; $i < 7; $i++) {
                    $data = array(
                        'ta'            => trim(htmlspecialchars($_POST['ta'])),
                        'ta_lalu'       => trim(htmlspecialchars($_POST['ta_lalu'])),
                        'kode'          => trim(htmlspecialchars($kode[$i])),
                        'bayar'         => trim(htmlspecialchars($_POST['bayar'][$i])),
                        'bayar_lalu'    => trim(htmlspecialchars($_POST['bayar_lalu'][$i])),
                        'total'    => trim(htmlspecialchars($_POST['total'][$i])),
                        'ket'           => trim(htmlspecialchars($_POST['ket'][$i])),
                    );

                    $this->db->set('id_siswa', $_POST['id_siswa']);
                    $this->db->set('created_at', date('Y-m-d H:i:s'));
                    $this->db->insert('tb_user_tagihan', $data);
                    $aff = 'Data berhasil tersimpan';
                }
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
