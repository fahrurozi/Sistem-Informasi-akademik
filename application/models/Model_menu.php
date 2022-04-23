<?php

Class Model_menu extends CI_Model {
    
    public $table = 'tb_menu';

    //Menyimpan data yang ditambahkan
    function save() {
        $data = array(
            'icon'         => $this->input->post('icon', TRUE),
            'nama_menu'    => $this->input->post('nama_menu', TRUE),
            'url'          => $this->input->post('url', TRUE),
            'is_main_menu' => $this->input->post('is_main_menu', TRUE)
        );

        $this->db->insert($this->table, $data);
    }

    //Memperbarui data yang di edit
    function update() {
        $data = array(
            'icon'         => $this->input->post('icon', TRUE),
            'nama_menu'    => $this->input->post('nama_menu', TRUE),
            'url'          => $this->input->post('url', TRUE),
            'is_main_menu' => $this->input->post('is_main_menu', TRUE)
        );

        $id_menu   = $this->input->post('id_menu');
        $this->db->where('id_menu', $id_menu);
        $this->db->update($this->table, $data);
    }




}

?>
