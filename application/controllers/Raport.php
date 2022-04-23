<?php
class Raport extends CI_Controller{

    function __construct() {
        parent:: __construct();
        $this->load->library('ssp');
    }


    function index(){
        chekAksesModule();
        if($this->session->userdata('id_level_user')!=3){
            //$sql = "SELECT kn.* FROM v_kelas_nilai kn LEFT JOIN tb_walikelas wk ON kn.id_rombel = wk.id_rombel WHERE kn.id_rombel= wk.id_rombel";
            //$sql = "SELECT tj.*, tr.kelas, tr.nama_rombel, tr.id_rombel FROM tb_jurusan tj LEFT JOIN tb_rombel tr ON tr.id_jurusan = tj.id_jurusan";
            //$data['jurusan'] = $this->db->query($sql);
            //$this->template->load('template', 'raport/list_kelas', $data);


            $this->template->load('template','raport/raport_data');
        }else{
            $walikelas  = $this->db->get_where('tb_walikelas',array('id_guru'=> $this->session->userdata('id_guru')))->row_array();
       
            $rombel     = "SELECT r.nama_rombel,r.kelas,j.nama_jurusan
                        FROM tb_rombel as r
                        LEFT JOIN tb_jurusan j ON j.id_jurusan = r.id_jurusan
                        WHERE r.id_rombel = ".$this->session->userdata('id_rombel');
                        
            $siswa      = "SELECT s.nis,s.nama 
                            FROM tb_history_kelas as hk,tb_siswa as s 
                            WHERE hk.nis=s.nis and hk.id_rombel=s.id_rombel and s.id_rombel = ".$this->session->userdata('id_rombel');
            $data['rombel'] = $this->db->query($rombel)->row_array();
            $data['siswa'] = $this->db->query($siswa);
            
            $this->template->load('template','raport/list_siswa',$data);
        }
    }

    function data() {
       
        $table = 'v_jurusan_raport';
        $primaryKey = 'id_jurusan';
        $columns = array(
            array('db' => 'id_jurusan', 'dt' => 'id_jurusan'),
            array('db' => 'nama_jurusan', 'dt' => 'nama_jurusan'),
            array('db' => 'kelas', 'dt' => 'kelas'),
            array('db' => 'nama_rombel', 'dt' => 'nama_rombel'),
            array('db' => 'id_rombel', 'dt' => 'id_rombel'),
            array(
                'db' => 'id_rombel',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('raport/rombel/'.$d,'<i class ="fa fa-eye" aria-hidden="true"></i>',"title='Lihat Kelas'");
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
        $id_rombel = $this->uri->segment(3);
        
        
        $rombel     = "SELECT r.nama_rombel,r.kelas,j.nama_jurusan
                        FROM tb_rombel as r
                        LEFT JOIN tb_jurusan j ON j.id_jurusan = r.id_jurusan
                        WHERE r.id_rombel = '$id_rombel'";
         $siswa      = "SELECT s.nis,s.nama 
         FROM tb_history_kelas as hk,tb_siswa as s 
         WHERE hk.nis=s.nis and hk.id_rombel=s.id_rombel and s.id_rombel = '$id_rombel'";
        $data['rombel'] = $this->db->query($rombel)->row_array();
        $data['siswa']  = $this->db->query($siswa);
      
        $this->template->load('template', 'raport/list_siswa',$data);
    }
        
    

    function nilai_semester(){
   chekAksesModule();
        $nis        = $this->uri->segment(3);
        $sqlSiswa   = "Select ts.nama,ts.nis,tj.nama_jurusan,tr.nama_rombel
                        FROM tb_history_kelas as hk,tb_siswa as ts,tb_rombel as tr,tb_jurusan as tj
                        WHERE ts.nis=hk.nis and tr.id_rombel=ts.id_rombel and tr.id_jurusan=tj.id_jurusan
                        and hk.nis='$nis' and hk.id_tahun_ajaran=". get_tahun_ajaran_aktif('id_tahun_ajaran');
        $siswa = $this->db->query($sqlSiswa)->row_array();

        $this->load->library('CFPDF');
        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
        $pdf->SetFont('Helvetica','B',10);

        $pdf->Cell(20, 5, 'NIS', 0, 0, 'L');
        $pdf->Cell(88, 5, ': '.$siswa['nis'], 0, 0, 'L');
        $pdf->Cell(40, 5, 'KELAS', 0, 0, 'L');
        $pdf->Cell(40, 5, ': '.$siswa['nama_rombel'], 0, 1, 'L');

        $pdf->Cell(20, 5, 'NAMA', 0, 0, 'L');
        $pdf->Cell(88, 5, ': '.$siswa['nama'], 0, 0, 'L');
        $pdf->Cell(40, 5, 'TAHUN AJARAN', 0, 0, 'L');
        $pdf->Cell(40, 5, ': '. get_tahun_ajaran_aktif('tahun_ajaran'), 0, 1, 'L');

        $pdf->Cell(20, 5, 'JURUSAN', 0, 0, 'L');
        $pdf->Cell(88, 5, ': '.$siswa['nama_jurusan'], 0, 0, 'L');
        $pdf->Cell(40, 5, 'SEMESTER', 0, 0, 'L');
        $pdf->Cell(40, 5, ': '. get_tahun_ajaran_aktif('semester_aktif'), 0, 1, 'L');

        $pdf->Cell(1, 10, '', 0, 1);

        $pdf->Cell(8, 5, 'No.', 1, 0, 'C');
        $pdf->Cell(75, 5, 'Mata Pelajaran', 1, 0, 'C');
        $pdf->Cell(10, 5, 'KKM', 1, 0, 'C');
        $pdf->Cell(20, 5, 'Angka', 1, 0, 'C');
        $pdf->Cell(35, 5, 'Huruf', 1, 0, 'C');
        $pdf->Cell(20, 5, 'Kecapaian', 1, 0, 'C');
        $pdf->Cell(20, 5, 'Rata Kelas', 1, 1, 'C');

        $pdf->SetFont('Helvetica','',8);
        //$sqlJadwal = "SELECT * FROM tb_jadwal WHERE id_jadwal";
        //$hasilJadwal = $this->db->query($sqlJadwal)->row_array();
        //$sqlRombel = "SELECT * FROM tb_jadwal WHERE id_jadwal";

       //$id_rombel = $hasilJadwal['id_rombel'];

       $sqlidRombel = "SELECT tj.id_jadwal, tm.nama_mapel , thk.id_rombel 
                        FROM tb_jadwal as tj, tb_mapel as tm , tb_history_kelas as thk 
                        WHERE tj.id_mapel=tm.id_mapel and tj.id_rombel=thk.id_rombel";
						
					
       $idrombel = $this->db->query($sqlidRombel)->result();
       $id_rombel = $idrombel[0]->id_rombel;
        $sqlMapel   = "SELECT tj.id_jadwal, tm.nama_mapel 
                        FROM tb_jadwal as tj, tb_mapel as tm 
                        WHERE tj.id_mapel=tm.id_mapel and tj.id_rombel='$id_rombel'";
                
        $mapel      = $this->db->query($sqlMapel)->result();
        $id_rombel = $mapel[0]->id_jadwal;
		
		
        //$arraymapel = json_decode(json_encode($mapel), true);
        //print_r($arraymapel[0]['id_jadwal']);
        //die;
        $no=1;
        foreach($mapel as $m){
            $pdf->Cell(8, 5,$no, 1, 0, 'C');
            $pdf->Cell(75, 5, $m->nama_mapel, 1, 0, 'L');
            $pdf->Cell(10, 5, '75', 1, 0, 'C');
            $nilai = chek_nilai($siswa['nis'], $m->id_jadwal);
            $pdf->Cell(20, 5, $nilai, 1, 0, 'C');
            $pdf->Cell(35, 5, Terbilang($nilai), 1, 0, 'L');
            $pdf->Cell(20, 5, $this->ketercapaian_kompetensi($nilai), 1, 0, 'C');
            $pdf->Cell(20, 5, ceil($this->rata_rata_nilai($m->id_jadwal)), 1, 1, 'C');
        }


        $pdf->Output();
    }

    function rata_rata_nilai($id_jadwal){
        $sql    = "SELECT sum(nilai)/count(nis) as nilai_rata_rata FROM tb_nilai WHERE id_jadwal=$id_jadwal";
        $nilai  = $this->db->query($sql)->row_array();
        return $nilai['nilai_rata_rata'];
    }


    function ketercapaian_kompetensi($nilai){
        if($nilai > 90){
            return 'Sangat Baik';
        }elseif($nilai>80 and $nilai <= 90){
            return 'Baik';
        }elseif($nilai>75 and $nilai <= 80){
            return 'Cukup';
        }else{
            return 'Kurang';
        }
    }
}

?>
