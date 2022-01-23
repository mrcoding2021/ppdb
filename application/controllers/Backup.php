<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
	public function index() {
		$this->load->dbutil();
		$this->load->helper('file');
        $this->load->helper('download');
		
		$config = array(
			'format'	=> 'zip',
			'filename'	=> 'database.sql'
		);
		
		$backup =& $this->dbutil->backup($config);
		
		$save = FCPATH.'asset/backup//backup-'.date("ymdHis").'-db.zip';
		
		write_file($save, $backup);
        force_download('backup.zip', $backup);
	}
}
