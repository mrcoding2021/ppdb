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

      $kode =  $db['key'][0]->id_murid;
      // SPP 
      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'SPP');
      $this->db->select_sum('kredit', 'total');
      $spp = $this->db->get('tb_transaksi')->row();

      // PEMBANGUNAN 
      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'PEMBANGUNAN');
      $this->db->select_sum('kredit', 'total');
      $pembangunan = $this->db->get('tb_transaksi')->row();

      // KEGIATAN 
      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'KEGIATAN');
      $this->db->select_sum('kredit', 'total');
      $kegiatan = $this->db->get('tb_transaksi')->row();

      // SERAGAM 
      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'SERAGAM');
      $this->db->select_sum('kredit', 'total');
      $seragam = $this->db->get('tb_transaksi')->row();

      // KOMITE
      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'KOMITE');
      $this->db->select_sum('kredit', 'total');
      $komite = $this->db->get('tb_transaksi')->row();

      // BUKU 
      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'BUKU PAKET');
      $this->db->select_sum('kredit', 'total');
      $buku = $this->db->get('tb_transaksi')->row();

      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'SARPRAS');
      $this->db->select_sum('kredit', 'total');
      $sarpras = $this->db->get('tb_transaksi')->row();

      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('kode', 'SPP');
      $this->db->where('id_murid', $kode);
      $this->db->select_sum('bayar', 'total');
      $tagSPP = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'PEMBANGUNAN');
      $this->db->select_sum('bayar', 'total');
      $tagPembangunan = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'KEGIATAN');
      $this->db->select_sum('bayar', 'total');
      $tagKegiatan = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'SERAGAM');
      $this->db->select_sum('bayar', 'total');
      $tagSeragam = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'KOMITE');
      $this->db->select_sum('bayar', 'total');
      $tagKomite = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'BUKU PAKET');
      $this->db->select_sum('bayar', 'total');
      $tagBuku = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $db['key'][0]->ta);
      $this->db->where('id_murid', $kode);
      $this->db->where('kode', 'SARPRAS');
      $this->db->select_sum('bayar', 'total');
      $tagSarpras = $this->db->get('tb_user_tagihan')->row();

      if ($tagPembangunan == null) {
        $a = 0;
      } else {
        $a = $tagPembangunan->total - $pembangunan->total;
      }
      if ($tagKegiatan == null) {
        $b = 0;
      } else {
        $b = $tagKegiatan->total - $kegiatan->total;
      }
      if ($tagSeragam == null) {
        $c = 0;
      } else {
        $c = $tagSeragam->total - $seragam->total;
      }
      if ($tagKomite == null) {
        $d = 0;
      } else {
        $d = $tagKomite->total - $komite->total;
      }
      if ($tagBuku == null) {
        $e = 0;
      } else {
        $e = $tagBuku->total - $buku->total;
      }
      if ($tagSPP == null) {
        $f = 0;
      } else {
        $f = $tagSPP->total - $spp->total;
      }
      if ($tagSarpras == null) {
        $g = 0;
      } else {
        $g = $tagSarpras->total - $sarpras->total;
      }
      $h = $a + $b + $c + $d + $e + $f + $g;

      $db['total'] = [$a, $b, $c, $d, $e, $f, $g];
      // $db['total'] = ['1'];

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

  public function setoranBSI($start, $end)
  {
    // $start = $this->input->post('start');
    // $end = $this->input->post('end');
    // $start = '2022-01-21';
    // $end = '2022-02-01';
    $tcs = 0;
    $ttf = 0;
    $tpot = 0;
    $ttotal = 0;
    $tsetoran = 0;
    $kode = ['PEMBANGUNAN', 'KEGIATAN', 'SERAGAM', 'KOMITE', 'BUKU PAKET', 'SPP',  'SARPRAS'];
    for ($i = 0; $i < 7; $i++) {

      $this->db->where('date >=', $start);
      $this->db->where('date <=', $end);
      $this->db->where('kode', $kode[$i]);
      $this->db->where('metode', 1);
      $this->db->select_sum('kredit', 'total');
      $cash = $this->db->get('tb_transaksi')->row();

      if ($cash == []) {
        $cs = 0;
      } else {
        $cs = $cash->total;
      }
      $this->db->where('date >=', $start);
      $this->db->where('date <=', $end);
      $this->db->where('kode', $kode[$i]);
      $this->db->where('metode', 1);
      $this->db->where('kode', 'TABUNGAN');
      $this->db->select_sum('kredit', 'total');
      $tabungan = $this->db->get('tb_transaksi')->row();
      if ($tabungan == []) {
        $tab = 0;
      } else {
        $tab = $tabungan->total;
      }

      $this->db->where('date >=', $start);
      $this->db->where('date <=', $end);
      $this->db->where('kode', $kode[$i]);
      $this->db->select_sum('kredit', 'total');
      $transfer = $this->db->get('tb_transaksi')->row();

      if ($transfer == []) {
        $tf = 0;
      } else {
        $tf = $transfer->total;
      }

      $this->db->where('date >=', $start);
      $this->db->where('date <=', $end);
      $this->db->where('kode', $kode[$i]);
      $this->db->where('metode', 5);
      $this->db->select_sum('kredit', 'total');
      $potong = $this->db->get('tb_transaksi')->row();

      if ($potong == []) {
        $pot = 0;
      } else {
        $pot = $potong->total;
      }

      if ($cs > 0) {
        $tcs = $tcs + $cs;
        $tpot = $tpot + $pot;
        $ttf = $ttf + $tf;
        $ttotal = $ttotal + $cs + $tf;
        $tsetoran = $tsetoran + $cs - $tpot;
      }

      if ($start == $end) {
        $tgl = longdate_indo($start);
      } else {
        $tgl = longdate_indo($start) . ' s/d ' . longdate_indo($end);
      }

      $res[] = [
        'hari'      => $tgl,
        'jns'       => $kode[$i],
        'cash'      => ($cs == null) ? 0 : rupiah($cs),
        'tabungan'  => ($tab == null) ? 0 : rupiah($tab),
        'tcash'      => rupiah($tcs),
        'transfer'  => ($tf == null) ? 0 : rupiah($tf),
        'ttransfer'  => rupiah($ttf),
        'total'     => ($cs + $tf == 0) ? 0 : rupiah($cs + $tf),
        'ttotal'     => rupiah($ttotal),
        'potong'    => ($pot == null) ? 0 : rupiah($pot),
        'tpotong'    => rupiah($tpot),
        'setoran'   => ($cs - $pot == 0) ? 0 : rupiah($cs - $pot),
        'tsetoran'   => rupiah($tsetoran)
      ];
    }

    $db['key'] = $res;

    $this->load->view('print/setoranBSI', $db);
  }
}


/* End of file Cetak.php */
/* Location: ./application/controllers/Cetak.php */
