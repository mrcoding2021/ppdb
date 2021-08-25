<?php
defined('BASEPATH') or exit('No direct script access allowed');


use Dompdf\Dompdf;


class Pdf extends CI_Controller
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

  public function report($id = '')
  {
    $dompdf = new Dompdf();
    $this->db->where('id_pengajuan',$id);
    $data['key'] = $this->db->get('tb_pembiayaan')->row();
    $html = $this->load->view('admin/v_report', $data, TRUE);
    
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
    
  }

  public function dummy($id = '1.20201231'){
    $db['key'] = $this->db->get_where('tb_pembayaran', array('no_invoice' => $id))->result();


    $this->load->view('print/invoice',$db);
    
  }

  public function cetakPDF($id){
    $this->load->helper('rupiah');
    
    ob_start();
    $this->db->where('id_pengajuan', $id);
    $data['key'] = $this->db->get('tb_pembiayaan')->row();
    $this->load->view('print', $data);
    $html = ob_get_contents();
    ob_end_clean();

    require './application/libraries/html2pdf/html2pdf/autoload.php';

    $pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
    $pdf->WriteHTML($html);
    $pdf->Output('Pembiayaan '.$data['key']->nama.'.pdf', 'D');
  }
}
