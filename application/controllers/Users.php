<?php

Class Users extends CI_Controller {

	function __construct() {
        parent:: __construct();
        $this->load->library('ssp');        
        $this->load->helper(array('form', 'url'));
        $this->load->model('Model_users');
    }

    function data() {
        $table = 'v_user';
        $primaryKey = 'id_user';
        $columns = array(
            array('db' => 'foto', 'dt' => 'foto'),
            array('db' => 'nama_lengkap', 'dt' => 'nama_lengkap'),
            array('db' => 'nama_level', 'dt' => 'nama_level'),
            array(
                'db' => 'id_user',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('users/edit/'.$d, '<i class="fa fa-pencil"></i>','class="btn btn-primary" title="Edit"')."&nbsp;&nbsp;&nbsp;"
                          .anchor('users/delete/'.$d, '<i class="fa fa-trash"></i>','class="btn btn-danger" title="Delete"');
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
        chekAksesModule();
        $this->template->load('template','users/list');
    }

    //Menambahkan data
    function add() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            $uploadFoto = $this->upload_foto_user();
            $this->Model_users->save($uploadFoto);
            redirect('users');
        } else {
            $this->template->load('template','users/add');
        }
    }

    //Mengedit data
    function edit() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            $uploadFoto = $this->upload_foto_user();
            $this->Model_users->update($uploadFoto);
            redirect('users');
        } else {
            $id_user    = $this->uri->segment(3);
            $data['user'] = $this->db->get_where('tb_user', array('id_user'=>$id_user))->row_array();
            $this->template->load('template','users/edit',$data);
        }
    }

    //Menghapus data
    function delete() {
        chekAksesModule();
        $id_user    = $this->uri->segment(3);

        if(!empty($id_user)) {
            //memproses delete data
            $this->db->where('id_user', $id_user);
            $this->db->delete('tb_user');
        }

        redirect('users');
    }

    function upload_foto_user(){
        $config['upload_path']          = './assets/foto/foto_user';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 102400; // imb
        $this->upload->initialize($config);
        $this->upload->do_upload('userfile');
        echo $this->upload->display_errors('<p>', '</p>');
        $upload = $this->upload->data(); 
        return $upload['file_name'];

    }

    


    function rule(){
        chekAksesModule();
        $this->template->load('template','users/rule');
    }
    function modul(){
        $level_user = $_GET['level_user'];
        echo "<table id='Tabel' class='table table-striped table-bordered table-hover table-full-width dataTable' cellspacing='0' width='100%'>
        <thead>
            <tr>
                <th width='10'>NO.</th>
                <th>NAMA MODUL</th>
                <th>URL</th>
                <th>HAK AKSES</th>
            </tr>";
            $menu = $this->db->get('tb_menu');
            $no=1;
            foreach ($menu->result() as $row){
                echo "<tr><td>$no</td>
                    <td>".strtoupper($row->nama_menu)."</td>
                    <td>$row->url</td>
                    <td align='center'><input type='checkbox'";
                    $this->chek_akses($level_user, $row->id_menu);
                     echo " onClick='addRule($row->id_menu)'</td>
                    </tr>";
                $no++;
            }
        echo"</thead>
    </table>";
    }

    function chek_akses($level_user,$id_menu){
        $data   = array(
            'id_level_user'=>$level_user,
            'id_menu'=>$id_menu
        );
        $chek = $this->db->get_where('tb_user_rule',$data);
        if($chek->num_rows()>0){
            echo "checked";
        }
    }

    function addrule(){
        $level_user = $_GET['level_user'];
        $id_menu    = $_GET['id_menu'];
        $data       = array(
                        'id_level_user'=>$level_user,'
                        id_menu'=>$id_menu
        );
        
        $chek       = $this->db->get_where('tb_user_rule',$data);
       
        if($chek->num_rows()<1){
            $this->db->insert('tb_user_rule',$data);
            echo "insert";
            
        }else{
            $this->db->where('id_menu',$id_menu);
            $this->db->where('id_level_user',$level_user);
            $this->db->delete('tb_user_rule');
            echo "terhapus";
            
        }
    }
}

?>
