<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Database extends CI_Model
{

    public function get()
    {
        $result = $this->db->get('tb_user_menu')->result();
        $array = [];
        foreach ($result as $key) {
            $this->db->where('level', $key->id_user);
            $user = $this->db->get('tb_user')->result();
            $array[] = [
                'id_akses' => $key->id_user,
                'akses'     => $key->menu,
                'user'      => count($user),
                'status'    => ($key->status == 1) ? 'Aktif' : 'Tidak Aktif'
            ];
        }
        return $array;
    }

    public function user($id)
    {
        $this->db->where('level', $id);
        $result = $this->db->get('tb_user')->result();
        $array = [];
        $no = 1;
        foreach ($result as $key) {
            $array[] = [
                'id_user'  => $key->id_user,
                'no'       => $no++,
                'nama'     => $key->nama,
                'hp'       => $key->hp,
                'status'   => ($key->is_active == 1) ? 'Aktif' : 'Tidak Aktif',
            ];
        }
        return $array;
    }

    public function getAcc($table = 'tb_pembayaran', $inv = '283.20210408', $id = '')
    {
        $this->load->helper('rupiah');
        $this->load->helper('tgl_indo');
        $data = array();
        $no = 1;
        if ($id > 0) {
            $this->db->where('no_invoice', $inv);
            $this->db->select_sum('kredit', 'total');
            $kredit = $this->db->get($table)->row();

            $this->db->where('no_invoice', $inv);
            $this->db->select_sum('diskon', 'total');
            $diskon = $this->db->get($table)->row();

            $this->db->order_by('id_pembayaran', 'desc');
            $this->db->where('no_invoice', $inv);
            $result = $this->db->get($table)->result();
            $sum = 0;
            foreach ($result as $key) {

                // var_dump($kredit->total - $diskon->total);
                // die;
                $this->db->where('id_user', $key->id_murid);
                $siswa = $this->db->get('tb_user')->row();

                $this->db->where('kode_akun', $key->byr_utk);
                $akun = $this->db->get('tb_rab')->row();

                $this->db->where('id_sumber', $key->id_sumber);
                $sumber = $this->db->get('tb_sumber')->row();

                $data[] = array(
                    'tgl'       => shortdate_indo(substr($key->created_at,0,10)),
                    'inv'       => $inv,
                    'grandtotal' => rupiah($kredit->total - $diskon->total),
                    'nama'      => $siswa->nama,
                    'ta'        => $key->ta,
                    'kelas'     => $siswa->kelas,
                    'nis'       => $siswa->nis,
                    'pj'        => strtoupper($siswa->pj),
                    'akun'      => $akun->kode_akun,
                    'nama_akun' => strtoupper($akun->nama),
                    'sumber'    => $sumber->nama,
                    'ket'       => ($key->ket == null) ? '' : $key->ket,
                    'nilai'     => rupiah($key->kredit),
                    'diskon'    => rupiah($key->diskon),
                    'total'     => rupiah($key->kredit - $key->diskon),
                );
            }
            return $data;
        } else {
            $this->db->order_by('id_pembayaran', 'desc');
            $this->db->group_by('no_invoice');
            $result = $this->db->get($table)->result();

            foreach ($result as $key) {
                $this->db->where('no_invoice', $key->no_invoice);
                $this->db->select_sum('kredit', 'total');
                $kredit = $this->db->get($table)->row();

                $this->db->where('no_invoice', $key->no_invoice);
                $this->db->select_sum('diskon', 'total');
                $diskon = $this->db->get($table)->row();

                $this->db->where('id_user', $key->id_murid);
                $siswa = $this->db->get('tb_user')->row();

                if ($siswa) {
                    $nama = $siswa->nama;
                } else {
                    if ($key->kategori == 0) {
                        $nama = 'Pemasukan Kas';
                    } else {
                        $nama = 'Pengeluaran Kas';
                    }
                }

                if ($key->acc == 1) {
                    $span = '<span class="btn btn-success btn-border-circle btn-sm">Terima</span>';
                } elseif ($key->acc == 2) {
                    $span = '<span class="btn btn-danger btn-border-circle btn-sm">Tolak</span>';
                } else {
                    $span = '<span class="btn btn-warning btn-border-circle btn-sm">Menunggu</span>';
                }


                $data[] = array(
                    'no' => $no++,
                    'tgl'   => shortdate_indo(substr($key->created_at,0,10)),
                    'inv'   => $key->no_invoice,
                    'siswa' => $nama,
                    'status' => $span,
                    'jumlah' => rupiah($kredit->total - $diskon->total)
                );
            }

            return $data;
        }
    }

    public function accept($table, $inv, $id)
    {
        $this->db->where('no_invoice', $inv);
        $this->db->set('approve', $id);
        $this->db->update($table);
        // oke 
        
    }
}
