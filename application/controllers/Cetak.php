<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Cetak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('tgl_indo');
        $this->load->helper('rupiah');
        $this->load->helper('terbilang');
        $this->load->model('Model_global');
    }

    public function invoice($id = '1.20201231')
    {
        if ($this->scm->cekSecurity() == true) {
            $db['key'] = $this->db->get_where('tb_transaksi', array('id_trx' => $id))->result();
            $this->load->view('print/invoice', $db);
        }
    }

    public function pemasukan($id = '1.20201231')
    {
        if ($this->scm->cekSecurity() == true) {
            $db['key'] = $this->db->get_where('tb_pembayaran', array('no_invoice' => $id))->result();
            $db['sekolah'] = $this->db->get('sekolah')->row_array();
            $this->load->view('print/pemasukan', $db);
        }
    }

    public function pengeluaran($id = '1.20201231')
    {
        if ($this->scm->cekSecurity() == true) {
            $db['key'] = $this->db->get_where('tb_pembayaran', array('no_invoice' => $id))->result();
            $this->load->view('print/pengeluaran', $db);
        }
    }
}


/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */
