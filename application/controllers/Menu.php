<?php

Class Menu extends CI_Controller {

	function __construct() {
        parent:: __construct();
        $this->load->library('ssp');
        $this->load->model('Model_menu');
    }

    function data() {
        $table = 'tb_menu';
        $primaryKey = 'id_menu';
        $columns = array(
            array('db' => 'id_menu', 'dt' => 'id_menu'),
            array('db' => 'nama_menu', 'dt' => 'nama_menu'),
            array('db' => 'url', 'dt' => 'url'),
            array(
                'db' => 'is_main_menu',
                'dt' => 'is_main_menu',
                'formatter' => function($d) {
                    return $d==0?'Main Menu':'Sub Menu';
                }
            ),
            array(
                'db' => 'id_menu',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('menu/edit/'.$d, '<i class="fa fa-pencil"></i>','class="btn btn-primary" title="Edit"')."&nbsp;&nbsp;&nbsp;"
                          .anchor('menu/delete/'.$d, '<i class="fa fa-trash"></i>','class="btn btn-danger" title="Delete"');
                }
            )
            
        );
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
 
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    //Menampilkan data
    function index() {
        $this->template->load('template','menu/list');
    }

    //Menambahkan data
    function add() {
        if(isset($_POST['submit'])) {
            echo $this->Model_menu->save();
            redirect('menu');
        } else {
            $this->template->load('template','menu/add');
        }
    }

    //Mengedit data
    function edit() {
        if(isset($_POST['submit'])) {
            echo $this->Model_menu->update();
            redirect('menu');
        } else {
            $kode    = $this->uri->segment(3);
            $data['menu'] = $this->db->get_where('tb_menu', array('id_menu'=>$kode))->row_array();
            $this->template->load('template','menu/edit',$data);
        }
    }

    //Menghapus data
    function delete() {
        $kode    = $this->uri->segment(3);

        if(!empty($kode)) {
            //memproses delete data
            $this->db->where('id_menu', $kode);
            $this->db->delete('tb_menu');
        }

        redirect('menu');
    }
}

?>
