<?php 
Class Model_nilai extends CI_Model {
    
    public $table = 'tb_history_kelas';

    //Menyimpan data yang ditambahkan
    function save() {

        $chek_nis = $this->input->post('nis');
        $sql = $this->db->query("SELECT nis FROM tb_history_kelas WHERE nis=$chek_nis")->num_rows();
        if($sql<1){
            $data = array(
                'id_rombel'          => $this->input->post('id_rombel', TRUE),
                'nis'                => $this->input->post('nis', TRUE),
                'id_tahun_ajaran'    => $this->input->post('id_tahun_ajaran', TRUE),
            );
    
            $this->db->insert($this->table, $data);
        }else{
            $sql_nama_siswa = "SELECT thk.nis,ts.nama FROM tb_history_kelas thk LEFT JOIN tb_siswa ts ON thk.nis = ts.nis WHERE thk.nis=$chek_nis";
        $query_nama_siswa = $this->db->query($sql_nama_siswa)->row_array();

        $notification = '<p style="color:red; display:inline" >DATA YANG ANDA INPUT SUDAH ADA</p>';

        $spasi = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $this->session->set_flashdata(
            'message',
            $notification.$spasi."<p style='font-weight:700; color:green; display:inline'>"."NIS : ".$chek_nis.$spasi."NAMA : ".$query_nama_siswa['nama']."</p>"
            
        );
        redirect('nilai/add');
        }
        
       //header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

}
