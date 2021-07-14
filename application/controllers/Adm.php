<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Adm extends CI_Controller

{

	public function index()

	{

		$this->load->view('admin/login');

	}



	public function login()

	{



		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');

		$this->form_validation->set_rules('password', 'Password', 'trim|required');



		$user = htmlspecialchars($this->input->post('username'));

		$pass = htmlspecialchars($this->input->post('password'));

		$table = 'tb_user';

        
		if ($user && $pass) {
            

			$data = $this->db->get_where($table, array('nama' => $user))->row_array();

			if ($data['is_active'] == 1 && $data['password'] == $pass) {

				$array = array(

					'user' 	=> $data['nama'],

					'id'	=> $data['id_user'],

					'level'	=> $data['level'],

					'table'	=> $table

				);



				$this->session->set_userdata($array);

				$this->session->set_flashdata('alert', '<div class="alert alert-success">Selamat Datang SIPAJAR Admin Panel</div>');

				redirect('admin');

			} else {

				$this->session->set_flashdata('alert', '<div class="alert alert-danger">Username yang anda masukkan belum aktif</div>');

				redirect('adm');

			}

		} else {

			$data = $this->db->get_where($table, array('hp' => $user))->row_array();

			if ($this->form_validation->run() == TRUE) {

				if ($data) {

					if ($user == $data['hp'] && $pass == $data['password']) {

						if ($data['is_active'] == 1) {



							$array = array(

								'user' 	=> $data['nama'],

								'id'	=> $data['id_user'],

								'level'	=> $data['level'],

								'table'	=> $table

							);



							$this->session->set_userdata($array);

							$this->session->set_flashdata('alert', '<div class="alert alert-success">Selamat Datang SIPAJAR Admin Panel</div>');

							redirect('admin');

						} else {

							$this->session->set_flashdata('alert', '<div class="alert alert-danger">Username yang anda masukkan belum aktif</div>');

							redirect('auth');

						}

					} else {



						$this->session->set_flashdata('alert', '<div class="alert alert-danger">Password yang anda masukkan salah</div>');

						redirect('adm');

					}

				} else {

					$this->session->set_flashdata('alert', '<div class="alert alert-danger">Username yang anda masukkan tidak terdaftar</div>');

					redirect('adm');

				}

			} else {



				$this->session->set_flashdata('alert', '<div class="alert alert-danger">Username dan password yang anda masukkan salah</div>');

				redirect('adm');

			}

		}

	}



	public function ubah()

	{

		$id = $this->session->userdata('id');



		$this->db->where('id_user', $id);

		$user = $this->db->get('tb_user')->row();



		$pwd = htmlspecialchars($_POST['pwd']);

		$pwd1 = htmlspecialchars($_POST['pwd1']);

		$pwd2 = htmlspecialchars($_POST['pwd2']);



		if ($pwd == $user->password) {

			if ($pwd1 == $pwd2) {

				$this->db->where('password', $id);

				$this->db->set('password', $pwd);

				$this->db->update('tb_user');

				$this->session->set_flashdata('alert', '<div class="alert alert-success">Password Anda berhasil dirubah</div>');

				redirect('sipajar/profil');

			} else {

				$this->session->set_flashdata('alert', '<div class="alert alert-danger">Password yang Anda masukkan tidak sama</div>');

				redirect('sipajar/profil');

			}

		} else {

			$this->session->set_flashdata('alert', '<div class="alert alert-danger">Username dan password yang anda masukkan salah</div>');

			redirect('sipajar/profil');

		}

	}

}

