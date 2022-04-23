<?php

class Model_sekolah extends CI_Model{
    
    public $table = 'tb_sekolah_info';

    function update(){
        $data = array(
            'nama_sekolah'    => $this->input->post('nama_sekolah', TRUE),
            'alamat '         => $this->input->post('alamat', TRUE),
            'email'           => $this->input->post('email', TRUE),
            'telpon'          => $this->input->post('telpon', TRUE),
            'id_jenjang'      => $this->input->post('jenjang', TRUE),
        );

        $id_sekolah   = $this->input->post('id_sekolah');
        $this->db->where('id_sekolah', $id_sekolah);
        $this->db->update($this->table, $data);
    }

}


?>