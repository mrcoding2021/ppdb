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

    public function tunggakan($id = '1945')
    {
        if ($this->scm->cekSecurity() == true) {
            $db['key'] = $this->db->get_where('tb_user', array('id_user' => $id))->row();
        
            $this->db->select('ta');
            $this->db->group_by('ta');
            $ta = $this->db->get('tb_ta')->result();
        
            $no = 1;
            $nol = 1;
            $lunas = array();
            $hutang = array();
            foreach ($ta as $key) {
        
              // SPP 
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'SPP');
              $this->db->select_sum('kredit', 'total');
              $spp = $this->db->get('tb_transaksi')->row();
        
              // PEMBANGUNAN 
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'PEMBANGUNAN');
              $this->db->select_sum('kredit', 'total');
              $pembangunan = $this->db->get('tb_transaksi')->row();
        
              // KEGIATAN 
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'KEGIATAN');
              $this->db->select_sum('kredit', 'total');
              $kegiatan = $this->db->get('tb_transaksi')->row();
        
              // SERAGAM 
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'SERAGAM');
              $this->db->select_sum('kredit', 'total');
              $seragam = $this->db->get('tb_transaksi')->row();
        
              // KOMITE
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'KOMITE');
              $this->db->select_sum('kredit', 'total');
              $komite = $this->db->get('tb_transaksi')->row();
        
              // BUKU 
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'BUKU PAKET');
              $this->db->select_sum('kredit', 'total');
              $buku = $this->db->get('tb_transaksi')->row();
        
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'SARPRAS');
              $this->db->select_sum('kredit', 'total');
              $sarpras = $this->db->get('tb_transaksi')->row();
        
              $lunas[] = array(
                'no' => $no++,
                'ta'  => $key->ta,
                'pembangunan' => rupiah($pembangunan->total),
                'kegiatan' => rupiah($kegiatan->total),
                'seragam' => rupiah($seragam->total),
                'komite'  => rupiah($komite->total),
                'buku_paket' => rupiah($buku->total),
                'spp' => rupiah($spp->total),
                'sarpras' => rupiah($sarpras->total),
                'total'   => rupiah($pembangunan->total + $kegiatan->total + $seragam->total + $komite->total + $buku->total + $spp->total + $sarpras->total)
              );

              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'SPP');
              $tagSPP = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'PEMBANGUNAN');
              $tagPembangunan = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'KEGIATAN');
              $tagKegiatan = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'SERAGAM');
              $tagSeragam = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'KOMITE');
              $tagKomite = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'BUKU PAKET');
              $tagBuku = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('id_murid', $id);
              $this->db->where('kode', 'SARPRAS');
              $tagSarpras = $this->db->get('tb_transaksi')->row();

              if ($tagPembangunan->tagihan == 0) {
                $a = 0;
              } else {
                $a = $tagPembangunan->tagihan - $pembangunan->total;
              }
              if ($tagKegiatan->tagihan == 0) {
                $b = 0;
              } else {
                $b = $tagKegiatan->tagihan - $kegiatan->total;
              }
              if ($tagSeragam->tagihan == 0) {
                $c = 0;
              } else {
                $c = $tagSeragam->tagihan - $seragam->total;
              }
              if ($tagKomite->tagihan == 0) {
                $d = 0;
              } else {
                $d = $tagKomite->tagihan - $komite->total;
              }
              if ($tagBuku->tagihan == 0) {
                $e = 0;
              } else {
                $e = $tagBuku->tagihan - $buku->total;
              }
              if ($tagSPP->tagihan == 0) {
                $f = 0;
              } else {
                $f = $tagSPP->tagihan - $spp->total;
              }
              if ($tagSarpras->tagihan == 0) {
                $g = 0;
              } else {
                $g = $tagSarpras->tagihan - $sarpras->total;
              }
              $h = $a + $b + $c + $d + $e + $f + $g;
        
              $hutang[] = array(
                'no' => $nol++,
                'ta'  => $key->ta,
                'pembangunan' => ($a == 0) ? 0 : rupiah($a),
                'kegiatan' => ($b == 0) ? 0 : rupiah($b),
                'seragam' => ($c == 0) ? 0 : rupiah($c),
                'komite'  => ($d == 0) ? 0 : rupiah($d),
                'buku_paket' => ($e == 0) ? 0 : rupiah($e),
                'spp' => ($f == 0) ? 0 : rupiah($f),
                'sarpras' => ($g == 0) ? 0 : rupiah($g),
                'total'   => ($h == 0) ? 0 : rupiah($h)
              );
            }

            $db['lunas'] = $lunas;
            $db['hutang'] = $hutang;
            $this->load->view('print/tunggakan', $db);
        }
    }
    public function tunggakanAll()
    {
        if ($this->scm->cekSecurity() == true) {
        
            $this->db->select('ta');
            $this->db->group_by('ta');
            $ta = $this->db->get('tb_ta')->result();
        
            $no = 1;
            $nol = 1;
            $lunas = array();
            $hutang = array();
            foreach ($ta as $key) {
        
              // SPP 
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'SPP');
              $this->db->select_sum('kredit', 'total');
              $spp = $this->db->get('tb_transaksi')->row();
        
              // PEMBANGUNAN 
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'PEMBANGUNAN');
              $this->db->select_sum('kredit', 'total');
              $pembangunan = $this->db->get('tb_transaksi')->row();
        
              // KEGIATAN 
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'KEGIATAN');
              $this->db->select_sum('kredit', 'total');
              $kegiatan = $this->db->get('tb_transaksi')->row();
        
              // SERAGAM 
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'SERAGAM');
              $this->db->select_sum('kredit', 'total');
              $seragam = $this->db->get('tb_transaksi')->row();
        
              // KOMITE
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'KOMITE');
              $this->db->select_sum('kredit', 'total');
              $komite = $this->db->get('tb_transaksi')->row();
        
              // BUKU 
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'BUKU PAKET');
              $this->db->select_sum('kredit', 'total');
              $buku = $this->db->get('tb_transaksi')->row();
        
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'SARPRAS');
              $this->db->select_sum('kredit', 'total');
              $sarpras = $this->db->get('tb_transaksi')->row();
        
              $lunas[] = array(
                'no' => $no++,
                'ta'  => $key->ta,
                'pembangunan' => rupiah($pembangunan->total),
                'kegiatan' => rupiah($kegiatan->total),
                'seragam' => rupiah($seragam->total),
                'komite'  => rupiah($komite->total),
                'buku_paket' => rupiah($buku->total),
                'spp' => rupiah($spp->total),
                'sarpras' => rupiah($sarpras->total),
                'total'   => rupiah($pembangunan->total + $kegiatan->total + $seragam->total + $komite->total + $buku->total + $spp->total + $sarpras->total)
              );

              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'SPP');
              $tagSPP = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'PEMBANGUNAN');
              $tagPembangunan = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'KEGIATAN');
              $tagKegiatan = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'SERAGAM');
              $tagSeragam = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'KOMITE');
              $tagKomite = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'BUKU PAKET');
              $tagBuku = $this->db->get('tb_transaksi')->row();
              $this->db->where('ta', $key->ta);
              $this->db->where('kode', 'SARPRAS');
              $tagSarpras = $this->db->get('tb_transaksi')->row();

              if ($tagPembangunan->tagihan == 0) {
                $a = 0;
              } else {
                $a = $tagPembangunan->tagihan - $pembangunan->total;
              }
              if ($tagKegiatan->tagihan == 0) {
                $b = 0;
              } else {
                $b = $tagKegiatan->tagihan - $kegiatan->total;
              }
              if ($tagSeragam->tagihan == 0) {
                $c = 0;
              } else {
                $c = $tagSeragam->tagihan - $seragam->total;
              }
              if ($tagKomite->tagihan == 0) {
                $d = 0;
              } else {
                $d = $tagKomite->tagihan - $komite->total;
              }
              if ($tagBuku->tagihan == 0) {
                $e = 0;
              } else {
                $e = $tagBuku->tagihan - $buku->total;
              }
              if ($tagSPP->tagihan == 0) {
                $f = 0;
              } else {
                $f = $tagSPP->tagihan - $spp->total;
              }
              if ($tagSarpras->tagihan == 0) {
                $g = 0;
              } else {
                $g = $tagSarpras->tagihan - $sarpras->total;
              }
              $h = $a + $b + $c + $d + $e + $f + $g;
        
              $hutang[] = array(
                'no' => $nol++,
                'ta'  => $key->ta,
                'pembangunan' => ($a == 0) ? 0 : rupiah($a),
                'kegiatan' => ($b == 0) ? 0 : rupiah($b),
                'seragam' => ($c == 0) ? 0 : rupiah($c),
                'komite'  => ($d == 0) ? 0 : rupiah($d),
                'buku_paket' => ($e == 0) ? 0 : rupiah($e),
                'spp' => ($f == 0) ? 0 : rupiah($f),
                'sarpras' => ($g == 0) ? 0 : rupiah($g),
                'total'   => ($h == 0) ? 0 : rupiah($h)
              );
            }

            $db['lunas'] = $lunas;
            $db['hutang'] = $hutang;
            $this->load->view('print/tunggakanAll', $db);
        }
    }
}


/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */
