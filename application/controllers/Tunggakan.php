<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Tunggakan extends CI_Controller
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
      $data['menu'] = $this->db->get('tb_menu')->result_array();
      $data['post'] = $this->db->get('tb_post')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $data['pembayaran'] = $this->db->get('tb_pembayaran')->result();
      $this->load->view('admin/header', $data);
      $this->load->view($data['view'], $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('home/');
    }
  }

  public function index()
  {
    $data = [
      'title'    => 'Tunggakan Siswa',
      'view'     => 'admin/pemasukan/index'
    ];
    $this->core($data);
  }

  public function all()
  {
    $data = [
      'title'    => 'Tunggakan Keseleluruhan',
      'view'     => 'pembayaran/tunggakanAll'
    ];
    $this->core($data);
  }

  public function lunas($nama = '')
  {

    if ($nama) {
      $this->db->like('id_user', $nama);
      $this->db->or_like('nama', $nama);
      $user = $this->db->get('tb_user')->row();

      $id = $user->id_user;
    } else {
      $id = null;
    }

    // $this->db->where('kategori_murid', $user->kategori_murid);
    $this->db->select('ta');
    $this->db->group_by('ta');
    $ta = $this->db->get('tb_ta')->result();

    $no = 1;
    $data = array();
    foreach ($ta as $key) {

      // SPP 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SPP');
      $this->db->select_sum('kredit', 'total');
      $spp = $this->db->get('tb_transaksi')->row();

      // PEMBANGUNAN 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'PEMBANGUNAN');
      $this->db->select_sum('kredit', 'total');
      $pembangunan = $this->db->get('tb_transaksi')->row();

      // KEGIATAN 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'KEGIATAN');
      $this->db->select_sum('kredit', 'total');
      $kegiatan = $this->db->get('tb_transaksi')->row();

      // SERAGAM 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SERAGAM');
      $this->db->select_sum('kredit', 'total');
      $seragam = $this->db->get('tb_transaksi')->row();

      // KOMITE
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'KOMITE');
      $this->db->select_sum('kredit', 'total');
      $komite = $this->db->get('tb_transaksi')->row();

      // BUKU 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'BUKU PAKET');
      $this->db->select_sum('kredit', 'total');
      $buku = $this->db->get('tb_transaksi')->row();

      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SARPRAS');
      $this->db->select_sum('kredit', 'total');
      $sarpras = $this->db->get('tb_transaksi')->row();

      $data[] = array(
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
    }

      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SPP');
      $this->db->select_sum('kredit', 'total');
      $spp = $this->db->get('tb_transaksi')->row();

      // PEMBANGUNAN 
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'PEMBANGUNAN');
      $this->db->select_sum('kredit', 'total');
      $pembangunan = $this->db->get('tb_transaksi')->row();

      // KEGIATAN 
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'KEGIATAN');
      $this->db->select_sum('kredit', 'total');
      $kegiatan = $this->db->get('tb_transaksi')->row();

      // SERAGAM 
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SERAGAM');
      $this->db->select_sum('kredit', 'total');
      $seragam = $this->db->get('tb_transaksi')->row();

      // KOMITE
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'KOMITE');
      $this->db->select_sum('kredit', 'total');
      $komite = $this->db->get('tb_transaksi')->row();

      // BUKU 
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'BUKU PAKET');
      $this->db->select_sum('kredit', 'total');
      $buku = $this->db->get('tb_transaksi')->row();

      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SARPRAS');
      $this->db->select_sum('kredit', 'total');
      $sarpras = $this->db->get('tb_transaksi')->row();

    $data[] = array(
      'no' => '-',
      'ta'  => 'GRAND TOTAL',
      'pembangunan' => rupiah($pembangunan->total),
      'kegiatan' => rupiah($kegiatan->total),
      'seragam' => rupiah($seragam->total),
      'komite'  => rupiah($komite->total),
      'buku_paket' => rupiah($buku->total),
      'spp' => rupiah($spp->total),
      'sarpras' => rupiah($sarpras->total),
      'total'   => rupiah($pembangunan->total + $kegiatan->total + $seragam->total + $komite->total + $buku->total + $spp->total + $sarpras->total)
    );

    echo json_encode($data);
  }

  public function hutang($nama = '')
  {
    if ($nama) {
      $this->db->like('id_user', $nama);
      $this->db->or_like('nama', $nama);
      $user = $this->db->get('tb_user')->row();

      $id = $user->id_user;
    } else {
      $id = null;
    }

    $this->db->select('ta');
    $this->db->group_by('ta');
    $ta = $this->db->get('tb_ta')->result();

    $no = 1;
    $data = array();
    foreach ($ta as $key) {

      // SPP 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SPP');
      $this->db->select_sum('kredit', 'total');
      $spp = $this->db->get('tb_transaksi')->row();

      // PEMBANGUNAN 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'PEMBANGUNAN');
      $this->db->select_sum('kredit', 'total');
      $pembangunan = $this->db->get('tb_transaksi')->row();

      // KEGIATAN 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'KEGIATAN');
      $this->db->select_sum('kredit', 'total');
      $kegiatan = $this->db->get('tb_transaksi')->row();

      // SERAGAM 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SERAGAM');
      $this->db->select_sum('kredit', 'total');
      $seragam = $this->db->get('tb_transaksi')->row();

      // KOMITE
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'KOMITE');
      $this->db->select_sum('kredit', 'total');
      $komite = $this->db->get('tb_transaksi')->row();

      // BUKU 
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'BUKU PAKET');
      $this->db->select_sum('kredit', 'total');
      $buku = $this->db->get('tb_transaksi')->row();

      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      } 
      $this->db->where('kode', 'SARPRAS');
      $this->db->select_sum('kredit', 'total');
      $sarpras = $this->db->get('tb_transaksi')->row();

      $this->db->where('ta', $key->ta);
      $this->db->where('kode', 'SPP');
      if ($id) {
        $this->db->where('id_murid', $id);
      } 
      $this->db->select_sum('bayar','total');
      $tagSPP = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'PEMBANGUNAN');
      $this->db->select_sum('bayar','total');     
      $tagPembangunan = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'KEGIATAN');
      $this->db->select_sum('bayar','total');     
      $tagKegiatan = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SERAGAM');
      $this->db->select_sum('bayar','total');     
      $tagSeragam = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'KOMITE');
      $this->db->select_sum('bayar','total');     
      $tagKomite = $this->db->get('tb_user_tagihan')->row();

      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'BUKU PAKET');
      $this->db->select_sum('bayar','total');     
      $tagBuku = $this->db->get('tb_user_tagihan')->row();
      
      $this->db->where('ta', $key->ta);
      if ($id) {
        $this->db->where('id_murid', $id);
      }
      $this->db->where('kode', 'SARPRAS');
      $this->db->select_sum('bayar','total');     
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

      $data[] = array(
        'no' => $no++,
        'ta'  => $key->ta,
        'pembangunan' => ($a == 0) ? 0 : str_replace('-', '+', rupiah($a)),
        'kegiatan' => ($b == 0) ? 0 : str_replace('-', '+', rupiah($b)),
        'seragam' => ($c == 0) ? 0 : str_replace('-', '+', rupiah($c)),
        'komite'  => ($d == 0) ? 0 : str_replace('-', '+', rupiah($d)),
        'buku_paket' => ($e == 0) ? 0 : str_replace('-', '+', rupiah($e)),
        'spp' => ($f == 0) ? 0 : str_replace('-', '+', rupiah($f)),
        'sarpras' => ($g == 0) ? 0 : str_replace('-', '+', rupiah($g)),
        'total'   => ($h == 0) ? 0 : str_replace('-', '+', rupiah($h))
      );
    }

     // SPP 
     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'SPP');
     $this->db->select_sum('kredit', 'total');
     $spp = $this->db->get('tb_transaksi')->row();

     // PEMBANGUNAN 
     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'PEMBANGUNAN');
     $this->db->select_sum('kredit', 'total');
     $pembangunan = $this->db->get('tb_transaksi')->row();

     // KEGIATAN 
     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'KEGIATAN');
     $this->db->select_sum('kredit', 'total');
     $kegiatan = $this->db->get('tb_transaksi')->row();

     // SERAGAM 
     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'SERAGAM');
     $this->db->select_sum('kredit', 'total');
     $seragam = $this->db->get('tb_transaksi')->row();

     // KOMITE
     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'KOMITE');
     $this->db->select_sum('kredit', 'total');
     $komite = $this->db->get('tb_transaksi')->row();

     // BUKU 
     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'BUKU PAKET');
     $this->db->select_sum('kredit', 'total');
     $buku = $this->db->get('tb_transaksi')->row();

     if ($id) {
       $this->db->where('id_murid', $id);
     } 
     $this->db->where('kode', 'SARPRAS');
     $this->db->select_sum('kredit', 'total');
     $sarpras = $this->db->get('tb_transaksi')->row();

     $this->db->where('kode', 'SPP');
     if ($id) {
       $this->db->where('id_murid', $id);
     } 
     $this->db->select_sum('bayar','total');
     $tagSPP = $this->db->get('tb_user_tagihan')->row();

     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'PEMBANGUNAN');
     $this->db->select_sum('bayar','total');     
     $tagPembangunan = $this->db->get('tb_user_tagihan')->row();

     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'KEGIATAN');
     $this->db->select_sum('bayar','total');     
     $tagKegiatan = $this->db->get('tb_user_tagihan')->row();

     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'SERAGAM');
     $this->db->select_sum('bayar','total');     
     $tagSeragam = $this->db->get('tb_user_tagihan')->row();

     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'KOMITE');
     $this->db->select_sum('bayar','total');     
     $tagKomite = $this->db->get('tb_user_tagihan')->row();

     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'BUKU PAKET');
     $this->db->select_sum('bayar','total');     
     $tagBuku = $this->db->get('tb_user_tagihan')->row();
     
     if ($id) {
       $this->db->where('id_murid', $id);
     }
     $this->db->where('kode', 'SARPRAS');
     $this->db->select_sum('bayar','total');     
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

    $data[] = array(
      'no' => '-',
      'ta'  => 'GRAND TOTAL',
      'pembangunan' => ($a == 0) ? 0 : str_replace('-', '+', rupiah($a)),
      'kegiatan' => ($b == 0) ? 0 : str_replace('-', '+', rupiah($b)),
      'seragam' => ($c == 0) ? 0 : str_replace('-', '+', rupiah($c)),
      'komite'  => ($d == 0) ? 0 : str_replace('-', '+', rupiah($d)),
      'buku_paket' => ($e == 0) ? 0 : str_replace('-', '+', rupiah($e)),
      'spp' => ($f == 0) ? 0 : str_replace('-', '+', rupiah($f)),
      'sarpras' => ($g == 0) ? 0 : str_replace('-', '+', rupiah($g)),
      'total'   => ($h == 0) ? 0 : str_replace('-', '+', rupiah($h))
    );

    echo json_encode($data);
  }
}


/* End of file Pemasukan.php */
/* Location: ./application/controllers/Pemasukan.php */
