<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Akses extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('tgl_indo');
    $this->load->model('database');
    
  }

  public function core($data)
  {
    $id = $this->session->userdata('id');
    if ($id) {
      $id = $this->session->userdata('id_user');
      $level = $this->session->userdata('level');
      $table = 'tb_user';
      $query = "SELECT `id_user`, `menu`
          FROM `tb_user_menu` JOIN `tb_menu_acces` 
            ON `tb_user_menu`.`id_user` = `tb_menu_acces`.`menu_id`
          WHERE `tb_menu_acces`.`role_id`= $level
        ORDER BY `tb_menu_acces`.`menu_id` ASC";
      $data['admin'] = $this->db->query($query)->result_array();
      $this->db->where_not_in('level', 3);
      $data['userfull'] = $this->db->get('tb_user')->result_array();
      $data['user'] = $this->db->get_where($table, array('id_user' => $id))->row_array();
      $this->load->view('admin/header', $data);
      $this->load->view('akses/'.$data['page'], $data);
      $this->load->view('admin/footer', $data);
    } else {
      redirect('auth');
    }
  }

  public function index(){
    $data = [
      'title'   => 'Hak Akses',
      'page'    => 'index',
      'parent'  => 'Admin Setting'
    ];
    $this->core($data);
  }

  public function get(){
    $data = $this->database->get();
    echo json_encode($data);
  }

  public function user($id)
  {
    $data = $this->database->user($id);
    echo json_encode($data);
  }
}


/* End of file Menu.php */
/* Location: ./application/controllers/Menu.php */
