<?php
class Nilai extends CI_Controller{

    function __construct() {
        parent:: __construct();
        $this->load->library('ssp');
        $this->load->model('Model_nilai');
        $this->load->library('form_validation');
    }


    function index(){
        chekAksesModule();
        
        if($this->session->userdata('id_level_user')==3){

            $walikelas  = $this->db->get_where('tb_walikelas',array('id_guru'=> $this->session->userdata('id_guru')))->row_array();


        $sql = "SELECT kn.* FROM v_kelas_nilai kn LEFT JOIN tb_walikelas wk ON kn.id_rombel = wk.id_rombel WHERE kn.id_rombel= ".$this->session->userdata('id_rombel');
        $data['rombel'] = $this->db->query($sql)->row_array();
        $data['jadwal'] = $this->db->query($sql);
        $this->template->load('template', 'nilai/list_kelas', $data);

        }else{
            $sql = "SELECT tj.id_rombel,tj.id_jadwal,tjr.nama_jurusan,tj.kelas,trom.nama_rombel, tm.nama_mapel,tj.jam,tr.nama_ruangan,tj.hari,tj.semester 
                    FROM tb_jadwal as tj,tb_jurusan as tjr, tb_ruangan as tr, tb_mapel as tm , tb_rombel as trom 
                    WHERE tj.id_jurusan=tjr.id_jurusan and tj.id_mapel=tm.id_mapel and tj.id_ruangan=tr.id_ruangan and trom.id_rombel=tj.id_rombel 
                    ORDER BY `tj`.`id_jadwal` ASC";
       $data['jadwal'] = $this->db->query($sql);
       $sql_rombel = "SELECT kn.* FROM v_kelas_nilai kn LEFT JOIN tb_walikelas wk ON kn.id_rombel = wk.id_rombel WHERE kn.id_rombel=wk.id_rombel";
       $data['rombel'] = $this->db->query($sql_rombel)->row_array();

        $this->template->load('template', 'nilai/list', $data);
        }
    }
     
        
        //$this->db->get('tb_siswa')->result(); 
       
       // $this->template->load('template','nilai/list');
        //$this->template->load('template','nilai/list_kelas',$data);
    

    function data(){
        $table = 'v_kelas_nilai';
        $primaryKey = 'id_rombel';
        $columns = array(
            array('db' => 'id_rombel', 'dt' => 'id_rombel'),
            array('db' => 'id_jadwal', 'dt' => 'id_jadwal'),
            array('db' => 'nama_jurusan', 'dt' => 'nama_jurusan'),
            array('db' => 'kelas', 'dt' => 'kelas'),
            array('db' => 'nama_rombel', 'dt' => 'nama_rombel'),
            array('db' => 'nama_mapel', 'dt' => 'nama_mapel'),
            array('db' => 'jam', 'dt' => 'jam'),
            array('db' => 'nama_ruangan', 'dt' => 'nama_ruangan'),
            array('db' => 'hari', 'dt' => 'hari'),
            array('db' => 'semester', 'dt' => 'semester'),
            array(
                'db' => 'id_jadwal',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('nilai/rombel/'.$d,'<i class ="fa fa-eye" aria-hidden="true"></i>',"title='Lihat Kelas'");
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

    function rombel(){
        //chekAksesModule();
        $id_jadwal = $this->uri->segment(3);
        $jadwal = $this->db->get_where('tb_jadwal',array('id_jadwal'=>$id_jadwal))->row_array();
        $id_rombel = $jadwal['id_rombel'];
        $rombel = "SELECT rb.nama_rombel,rb.kelas,jr.nama_jurusan,mp.nama_mapel 
                    FROM tb_jadwal as j,tb_jurusan as jr, tb_rombel as rb,tb_mapel as mp 
                    WHERE j.id_jurusan=jr.id_jurusan and rb.id_rombel=j.id_rombel and mp.id_mapel=j.id_mapel 
                    and j.id_jadwal='$id_jadwal'";
        $siswa  = "SELECT s.nis,s.nama
                    FROM tb_history_kelas as hk,tb_siswa as s
                    WHERE hk.nis=s.nis and hk.id_tahun_ajaran=".get_tahun_ajaran_aktif('id_tahun_ajaran')." and hk.id_rombel='$id_rombel'";
        $data['rombel'] = $this->db->query($rombel)->row_array();
        $data['siswa']  = $this->db->query($siswa)->result();
       
        $this->template->load('template', 'nilai/form_nilai',$data);
    }

    function update_nilai(){
        
        $nis        = $_GET['nis'];
        $id_jadwal  = $_GET['id_jadwal'];
        $nilai      = $_GET['nilai'];


        $params     = array('nis'=>$nis,'id_jadwal'=>$id_jadwal,'nilai'=>$nilai);

      
        $validasi   = array('nis'=>$nis,'id_jadwal'=>$id_jadwal);
        $chek       = $this->db->get_where('tb_nilai',$validasi);
        if($chek->num_rows()>0){
            //proses update
            $this->db->where('nis',$nis);
            $this->db->where('id_jadwal',$id_jadwal);
            $this->db->update('tb_nilai',array('nilai'=>$nilai));
        }else{
            $this->db->insert('tb_nilai',$params);
            echo "data sudah masuk";
        }
    }

    function add() {
        chekAksesModule();

       
        if(isset($_POST['submit'])) {
            echo $this->Model_nilai->save();
            redirect('nilai/');
        } else {
            $this->template->load('template','nilai/add');
        }
    }

}
?>
