<?php 

class Walikelas extends CI_Controller {
    

    function __construct() {
        parent::__construct();
        $this->load->library('ssp');
        $this->load->model('Model_walikelas');
    }

    function index() {
        chekAksesModule();
        if($this->session->userdata('id_level_user')==3){
            $id_jurusan = $this->session->userdata('id_jurusan');
        
        $sql = "SELECT vwk.*,tr.id_jurusan,tg.nip FROM v_walikelas vwk LEFT JOIN tb_walikelas wk ON vwk.id_walikelas = wk.id_walikelas LEFT JOIN tb_rombel tr ON tr.id_rombel=wk.id_rombel LEFT JOIN tb_guru tg ON vwk.nama_guru=tg.nama_guru WHERE id_jurusan='$id_jurusan'";
        //$this->template->load('template', 'walikelas/list');
        $data['walikelas'] = $this->db->query($sql);
        
        $this->template->load('template', 'walikelas/walikelas_list',$data);
        }else{

        $this->template->load('template', 'walikelas/list');
        }
    }

    function data() {
        $table = 'v_walikelas';
        $primaryKey = 'id_walikelas';
        $columns = array(
            array('db' => 'nama_rombel', 'dt' => 'nama_rombel'),
            array('db' => 'nama_jurusan', 'dt' => 'nama_jurusan'),
            array('db' => 'kelas', 'dt' => 'kelas'),
            //array('db' => 'nama_guru', 'dt' => 'nama_guru'),
            array('db' => 'id_walikelas',
                'dt' => 'nama_guru',
                'formatter' => function($d) {
                    $walikelas = $this->db->get_where('tb_walikelas',array('id_walikelas'=>$d))->row_array();
                    
                    return cmb_dinamis('guru', 'tb_guru', 'nama_guru', 'id_guru', $walikelas['id_guru'], "id='guru$d' onchange='updateDataWalikelas($d)'");
            }),
            
        );
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
 
        //$where = 'tahun_ajaran='.get_tahun_ajaran_aktif('tahun_ajaran');
        $where = "tahun_ajaran='".get_tahun_ajaran_aktif('tahun_ajaran')."'";

        echo json_encode(
                SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where)
        );
    } 

    //Menambahkan data
    function add() {
        chekAksesModule(); 
        if(isset($_POST['submit'])) {
            echo $this->Model_walikelas->save();
            redirect('walikelas');
        } else {
            $this->template->load('template','walikelas/add');
        }
    }

    

    function updateWalikelas() {
        $id_walikelas  = $_GET['id_walikelas'];
        $id_guru       = $_GET['id_guru'];
        $this->db->where('id_walikelas', $id_walikelas);
        $this->db->update('tb_walikelas',array('id_guru'=>$id_guru));
    }

    function show_combobox_semester_by_tahun_ajaran(){
        
        $id_tahun_ajaran = $_GET['id_tahun_ajaran'];
        
        echo "<select name='semester_aktif'  class='form-control' onchange='loadTahun()'>";
        $this->db->where('id_tahun_ajaran',$id_tahun_ajaran);
        $semester = $this->db->get('tb_tahun_ajaran');
        foreach ($semester->result() as $row){
            echo "<option value='$row->id_tahun_ajaran'>$row->semester_aktif</option>";
        }
        echo "</select>";
    }




    
}


?>