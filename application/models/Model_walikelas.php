<?php

class Model_walikelas extends CI_Model {


    public $table = 'tb_walikelas';

    function setup_walikelas($idTahunAjaran) {
        $guru = 
        $rombel = $this->db->get('tb_rombel');
        foreach ($rombel->result() as $row) {
            $walikelas = array (
                'id_guru'           => '2',
                'id_tahun_ajaran'   => $idTahunAjaran,
                'id_rombel'         => $row->id_rombel
            );
            $this->db->insert('tb_walikelas',$walikelas);
        }
    }

    function save() {
        $data = array (
            'id_guru' => $this->input->post('id_guru', TRUE),
            'id_tahun_ajaran' => $this->input->post('id_tahun_ajaran', TRUE),
            'id_rombel' => $this->input->post('id_rombel', TRUE),
        );
        $this->db->insert($this->table,$data);
    }

    
}



?>