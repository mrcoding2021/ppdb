<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Security_model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		
	}

	public function cekSecurity() {
		$id = $this->session->userdata('id');
		$username = $this->session->userdata('nama');
		$level = $this->session->userdata('level');
		if (empty($id) && empty($username) && empty($level)) {
			$this->session->sess_destroy();
			redirect('/');
		} else {
			return true;
		}
	}
}