<?php

Class Kurikulum extends CI_Controller {

	function __construct() {
        parent:: __construct();
        $this->load->library('ssp');
        $this->load->model('Model_kurikulum');
    }

    function data() {
        $table = 'tb_kurikulum';
        $primaryKey = 'id_kurikulum';
        $columns = array(
            array('db' => 'id_kurikulum', 'dt' => 'id_kurikulum'),
            array('db' => 'nama_kurikulum', 'dt' => 'nama_kurikulum'),
            array('db' => 'is_aktif', 
                  'dt' => 'is_aktif',
                  'formatter' => function($d) {
                      return $d=='y'?'AKTIF':'TIDAK';
                  }
            ),
            array(
                'db' => 'id_kurikulum',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    if($this->session->userdata('id_level_user')!=1){
                        return anchor('kurikulum/detail/'.$d, '<i class="fa fa-eye"></i>','class="btn btn-info" title="Detail"');
                    }else{
                        return anchor('kurikulum/edit/'.$d, '<i class="fa fa-pencil"></i>','class="btn btn-primary" title="Edit"')."&nbsp;&nbsp;&nbsp;"
                                .anchor('kurikulum/delete/'.$d, '<i class="fa fa-trash"></i>','class="btn btn-danger" title="Delete"')."&nbsp;&nbsp;&nbsp;"
                                .anchor('kurikulum/detail/'.$d, '<i class="fa fa-eye"></i>','class="btn btn-info" title="Detail"');
                    }
                    
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
        $this->template->load('template','kurikulum/list');
    }

    //Menambahkan data
    function add() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            echo $this->Model_kurikulum->save();
            redirect('kurikulum');
        } else {
            $this->template->load('template','kurikulum/add');
        }
    }

    //Mengedit data
    function edit() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            echo $this->Model_kurikulum->update();
            redirect('kurikulum');
        } else {
            $id_kurikulum    = $this->uri->segment(3);
            $data['kurikulum'] = $this->db->get_where('tb_kurikulum', array('id_kurikulum'=>$id_kurikulum))->row_array();
            $this->template->load('template','kurikulum/edit',$data);
        }
    }

    //Menghapus data
    function delete() {
        chekAksesModule();
        $id_kurikulum    = $this->uri->segment(3);

        if(!empty($id_kurikulum)) {
            //memproses delete data
            $this->db->where('id_kurikulum', $id_kurikulum);
            $this->db->delete('tb_kurikulum');
        }

        redirect('kurikulum');
    }


    function detail() {
        $infoSekolah = "SELECT js.jumlah_kelas
                        FROM tb_jenjang_sekolah as js, tb_sekolah_info as si 
                        WHERE js.id_jenjang=si.id_jenjang";
        $data['info']= $this->db->query($infoSekolah)->row_array();

        if($this->session->userdata('id_level_user')!=1){
            $this->template->load('template','kurikulum/detail_no_admin',$data);
        }else{
            $this->template->load('template','kurikulum/detail',$data);
        }
        
        
    }

    function dataKurikulumDetail() {

        $id_jurusan     = $_GET['jurusan'];
        $kelas          = $_GET['kelas'];
        $id_kurikulum   = $_GET['id_kurikulum'];

        if($kelas=='semua_kelas'){
            $selected_kelas = '';
        } else {
            $selected_kelas="and kd.kelas='$kelas'";
        }

        if($this->session->userdata('id_level_user')!=1){
            echo "<table id='Tabel' class='table table-striped table-bordered table-hover table-full-width dataTable'>
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>KODE MATA PELAJARAN</td>
                    <th>MATA PELAJARAN</th>
                    <th>KELAS</th>
                    
                </tr>
                
            </thead>";            
        }else{
            echo "<table id='Tabel' class='table table-striped table-bordered table-hover table-full-width dataTable'>
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>KODE MATA PELAJARAN</td>
                        <th>MATA PELAJARAN</th>
                        <th>KELAS</th>
                        <th>AKSI</th>
                    </tr>
                    
                </thead>";
        }
        

        $sql = "SELECT tj.nama_jurusan,tm.id_mapel,tm.nama_mapel,kd.kelas,kd.id_kurikulum_detail,kd.id_kurikulum
                FROM tb_kurikulum_detail as kd, tb_kurikulum as tk, tb_mapel as tm, tb_jurusan as tj
                WHERE kd.id_kurikulum=tk.id_kurikulum and kd.id_mapel=tm.id_mapel and kd.id_jurusan=tj.id_jurusan 
                $selected_kelas and kd.id_kurikulum='$id_kurikulum' and kd.id_jurusan='$id_jurusan';";
        $kurikulum = $this->db->query($sql)->result();
        $no=1;
        foreach ($kurikulum as $row){
            if($this->session->userdata('id_level_user')!=1){
                echo    "<tr>
                <td>$no</td>
                <td>$row->id_mapel</td>
                <td>$row->nama_mapel</td>
                <td>$row->kelas</td>
            </tr>";
            }else{
                echo    "<tr>
                <td>$no</td>
                <td>$row->id_mapel</td>
                <td>$row->nama_mapel</td>
                <td>$row->kelas</td>
                <td>".anchor('kurikulum/deletedetail/'.$row->id_kurikulum_detail.'/'.$row->id_kurikulum,'<i class="fa fa-trash"></i>','class="btn btn-danger"')."</td>
            </tr>";
            }
            
        }
        
        echo "</table>";
    }

    function adddetail() {
        chekAksesModule();
        if(isset($_POST['submit'])){
            $this->Model_kurikulum->addKurikulumDetail();
            redirect('kurikulum/detail/'.$this->input->post('id_kurikulum'));
        }else{
            $infoSekolah = "SELECT js.jumlah_kelas
                            FROM tb_jenjang_sekolah as js, tb_sekolah_info as si 
                            WHERE js.id_jenjang=si.id_jenjang";
            $data['info']=$this->db->query($infoSekolah)->row_array();
            $this->template->load('template','kurikulum/adddetail',$data);
        }
    }

    function deletedetail() {
        chekAksesModule();
        $id_kurikulum_detail    = $this->uri->segment(3);
        $id_kurikulum           = $this->uri->segment(4); 

        if(!empty($id_kurikulum_detail)) {
            //memproses delete data
            $this->db->where('id_kurikulum_detail', $id_kurikulum_detail);
            $this->db->delete('tb_kurikulum_detail');
        }

        redirect('kurikulum/detail/'.$id_kurikulum);
    }
}

?>
