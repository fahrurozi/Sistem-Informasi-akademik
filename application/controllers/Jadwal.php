<?php 

class Jadwal extends CI_Controller {

    function __construct() {
        parent:: __construct();
        $this->load->model('Model_jadwal');
    }

    function index() {
	
        if($this->session->userdata('id_level_user')==3) { //guru
            $mengajar = "SELECT tj.id_jadwal, trom.nama_rombel, tj.kelas, tm.nama_mapel, tj.jam, tr.nama_ruangan, tj.hari, tj.semester  
                         FROM tb_jadwal as tj, tb_jurusan as tjr, tb_ruangan as tr, tb_mapel as tm, tb_rombel as trom
                         WHERE tj.id_jurusan=tjr.id_jurusan and tj.id_mapel=tm.id_mapel and 
                         tj.id_ruangan=tr.id_ruangan and tj.id_guru=".$this->session->userdata('id_guru')." and tj.id_rombel=trom.id_rombel";

            $wk = "SELECT tj.id_jadwal, tg.nama_guru, tjr.nama_jurusan, tj.kelas, tm.nama_mapel, tj.jam, tr.nama_ruangan, tj.hari, tj.semester  
                   FROM tb_jadwal as tj, tb_jurusan as tjr, tb_ruangan as tr, tb_mapel as tm, tb_guru as tg
                   WHERE tj.id_jurusan=tjr.id_jurusan and tj.id_mapel=tm.id_mapel and 
                   tj.id_ruangan=tr.id_ruangan and tj.id_guru=tg.id_guru and tj.id_rombel=".$this->session->userdata('id_rombel');
           
            $data['mengajar'] = $this->db->query($mengajar);
            $data['wk'] = $this->db->query($wk);
            $this->template->load('template','jadwal/jadwal_ajar_guru',$data);

        } else if ($this->session->userdata('id_level_user')==1) { //admin
            $infoSekolah = "SELECT js.jumlah_kelas
                            FROM tb_jenjang_sekolah as js, tb_sekolah_info as si 
                            WHERE js.id_jenjang=si.id_jenjang";
            $data['info']= $this->db->query($infoSekolah)->row_array();

        $this->template->load('template', 'jadwal/list', $data);

        } else { //siswa
            $sql = "SELECT tj.id_jadwal, tj.kelas, tm.nama_mapel, tj.jam, tr.nama_ruangan, tj.hari, tj.semester 
                   FROM tb_jadwal as tj, tb_jurusan as tjr, tb_ruangan as tr, tb_mapel as tm
                   WHERE tj.id_jurusan=tjr.id_jurusan and tj.id_mapel=tm.id_mapel and tj.id_ruangan=tr.id_ruangan and
                   tj.id_rombel=".$this->session->userdata('id_rombel');
            $data['jadwal'] = $this->db->query($sql);

            $this->template->load('template','jadwal/jadwal_ajar_siswa',$data);
        }
    }


    function generate_jadwal() {
        if(isset($_POST['submit'])) {
            $this->Model_jadwal->generateJadwal();
        }
        redirect('jadwal');
    }

    function cetakJadwal() {
        $rombel = $_POST['showRombel'];
        $jurusan = $_POST['jurusan'];
        $kelas  = $_POST['kelas'];
        
        $this->load->library('CFPDF');
        $hari   = $this->Model_jadwal->hari();
        $jam    = $this->Model_jadwal->jamPelajaran();
        $nomor  = 1;

        $pdf = new FPDF('L','mm',array(230, 330));
        $pdf->AddPage();
        $pdf->SetMargins(8, 8, 8);
        $pdf->SetFont('Helvetica','B', 6);
        $pdf->SetFillColor(211, 211, 211);

        $pdf->Cell(0, 0, '', 0, 1, 'L');
        $pdf->Cell(20, 5, 'JURUSAN', 0, 0, 'L');
        $pdf->Cell(5, 5, '=', 0, 0, 'C');
        $pdf->Cell(48, 5, $jurusan, 0, 1, 'L');

        $pdf->Cell(20, 5, 'KELAS', 0, 0, 'L');
        $pdf->Cell(5, 5, '=', 0, 0, 'C');
        $pdf->Cell(48, 5, $kelas, 0, 1, 'L');      

        $pdf->Cell(48, 5, '', 0, 1, 'L');

        $pdf->Cell(5, 8, 'No.', 1, 0, 'C', true);
        $pdf->Cell(18, 8, 'Waktu', 1, 0, 'C', true);
        
        //foreach di kolom judul
        foreach($hari as $day) {
            $pdf->Cell(58, 8, $day, 1, 0, 'C', true);
        }
        $pdf->Cell(10, 8, '', 0, 1, 'C');
        // ------------- line break -------------
        foreach($jam as $waktu) {
            $pdf->Cell(5, 8, $nomor++, 1, 0, 'C');
            $pdf->Cell(18, 8, $waktu, 1, 0, 'C');

            //foreach hari di kolom jadwal
            foreach($hari as $day) {
                $pdf->Cell(58, 8, $this->getPelajaran($waktu, $day, $rombel), 1, 0, 'C');
            }
            $pdf->Cell(10, 8, '', 0, 1, 'C');
        }

        $pdf->Output();
    }


    function getPelajaran($jam, $hari, $rombel) {
        $sql        = "SELECT tj.*, tm.nama_mapel, tjr.nama_jurusan 
                       FROM tb_jadwal as tj, tb_mapel as tm, tb_jurusan as tjr
                       WHERE tj.id_mapel=tm.id_mapel AND tj.id_rombel=$rombel AND tj.hari='$hari' AND tj.jam='$jam'";
        $pelajaran  = $this->db->query($sql);

        if ($pelajaran->num_rows() > 0) {
            $row = $pelajaran->row_array();
            return $row['nama_mapel'];
        } else {
            return '-';
        }
    }

    function dataJadwal() {
        $id_jurusan     = $_GET['jurusan'];
        $kelas          = $_GET['kelas'];
        $rombel         = $_GET['rombel'];

        if($kelas=='semua_kelas'){
            $selected_kelas = '';
        } else {
            $selected_kelas="and kd.kelas='$kelas'";
        }

        echo "<table id='Tabel' class='table table-striped table-bordered table-hover table-full-width dataTable'>
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>HARI</th>
                        <th>JAM</th>
                        <th>MATA PELAJARAN</th>
                        <th>GURU</th>
                        <th>RUANGAN</th>
                        <th>AKSI</th>
                    </tr> 
                </thead>";

        $sql = "SELECT tj.hari, tj.id_jadwal, tm.id_mapel, tg.id_guru, tg.nama_guru, tr.id_ruangan, tj.hari, tj.jam
                FROM tb_jadwal AS tj, tb_mapel as tm, tb_guru as tg, tb_ruangan AS tr
                WHERE tj.id_mapel=tm.id_mapel AND tj.id_guru=tg.id_guru AND tj.id_ruangan=tr.id_ruangan AND 
                tj.kelas='$kelas' AND tj.id_jurusan='$id_jurusan' AND tj.id_rombel='$rombel'";

        $jadwal = $this->db->query($sql)->result();

        $nomor=1;
        $jam_pelajaran = $this->Model_jadwal->jamPelajaran();
        $hari          = $this->Model_jadwal->hari();

        foreach ($jadwal as $row){
            echo    "<tr>
                        <td>".$nomor++."</td>
                        <td>"
                            .form_dropdown(
                                'hari',
                                $hari, 
                                $row->hari,
                                "class='form-control' id='hari".$row->id_jadwal."' onchange='updateHari(".$row->id_jadwal.")'"
                            ).
                        "</td>
                        <td>"
                            .form_dropdown(
                                'jam', 
                                $jam_pelajaran, 
                                $row->jam, 
                                "class='form-control' id='jam".$row->id_jadwal."' onchange='updateJam(".$row->id_jadwal.")'"
                            ).
                        "</td>
                        <td>"
                            .cmb_dinamis(
                                'mapel', 
                                'tb_mapel', 
                                'nama_mapel', 
                                'id_mapel', 
                                $row->id_mapel, 
                                "id='mapel".$row->id_jadwal."' onchange='updateMapel(".$row->id_jadwal.")'"
                            ).
                        "</td>
                        <td>"
                            .cmb_dinamis(
                                'guru', 
                                'tb_guru', 
                                'nama_guru', 
                                'id_guru', 
                                $row->id_guru, 
                                "id='guru".$row->id_jadwal."' onchange='updateGuru(".$row->id_jadwal.")'"
                            ).
                        "</td>
                        <td>"
                            .cmb_dinamis(
                                'ruangan', 
                                'tb_ruangan', 
                                'nama_ruangan', 
                                'id_ruangan', 
                                $row->id_ruangan, 
                                "id='ruangan".$row->id_jadwal."' onchange='updateRuangan(".$row->id_jadwal.")'"
                            ).
                        "</td>
                        <td>".anchor('jadwal/delete/'.$row->id_jadwal,'<i class="fa fa-trash"></i>','class="btn btn-danger"')."</td>
                    </tr>";
        }
        
        echo "</table>";
    }

    function add() {
        if(isset($_POST['submit'])){
            $this->Model_jadwal->addJadwal();
        /* }else{
            $infoSekolah = "SELECT js.jumlah_kelas
                            FROM tb_jenjang_sekolah as js, tb_sekolah_info as si 
                            WHERE js.id_jenjang=si.id_jenjang";
            $data['info']=$this->db->query($infoSekolah)->row_array();
            $this->template->load('template','kurikulum/adddetail',$data); */
        } redirect('jadwal');
    }

    function jamUpdate() {
        $jam    = $_GET['jam'];
        $jadwal_id  = $_GET['id_jadwal'];

        $this->db->where('id_jadwal', $jadwal_id);
        $this->db->update('tb_jadwal', array('jam'=>$jam));
    }

    function guruUpdate() {
        $guru_id    = $_GET['id_guru'];
        $jadwal_id  = $_GET['id_jadwal'];

        $this->db->where('id_jadwal', $jadwal_id);
        $this->db->update('tb_jadwal', array('id_guru'=>$guru_id));
    }

    function mapelUpdate() {
        $mapel_id   = $_GET['id_mapel'];
        $jadwal_id  = $_GET['id_jadwal'];

        $this->db->where('id_jadwal', $jadwal_id);
        $this->db->update('tb_jadwal', array('id_mapel'=>$mapel_id));
    }

    function ruanganUpdate() {
        $ruangan    = $_GET['id_ruangan'];
        $jadwal_id  = $_GET['id_jadwal'];

        $this->db->where('id_jadwal', $jadwal_id);
        $this->db->update('tb_jadwal', array('id_ruangan'=>$ruangan));
    }

    function hariUpdate() {
        $hari_hari  = $_GET['hari'];
        $jadwal_id  = $_GET['id_jadwal'];

        $this->db->where('id_jadwal', $jadwal_id);
        $this->db->update('tb_jadwal', array('hari'=>$hari_hari));
    }

    //Menghapus data
    function delete() {
        chekAksesModule();
        $kode    = $this->uri->segment(3);

        if(!empty($kode)) {
            //memproses delete data
            $this->db->where('id_jadwal', $kode);
            $this->db->delete('tb_jadwal');
        }
        redirect('jadwal');
    }


    function tampilkanRombel() {
        echo "<select id='rombel' name='showRombel' class='form-control' onchange='loadData()'>";

        $jurusan    = $_GET['jurusan'];
        $kelas      = $_GET['kelas'];

        $this->db->where('id_jurusan', $jurusan);
        $this->db->where('kelas', $kelas);
        $rombel = $this->db->get('tb_rombel');

        foreach($rombel->result() as $row) {
            echo "<option value='$row->id_rombel'>
                    $row->nama_rombel
                  </option>";
        }
        echo "</select>";
    }

}

?>
