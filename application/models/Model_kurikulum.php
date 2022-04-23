<?php

Class Model_kurikulum extends CI_Model {
    
    public $table = 'tb_kurikulum';

    //Menyimpan data yang ditambahkan
    function save() {
        $data = array(
            'nama_kurikulum'     => $this->input->post('nama_kurikulum', TRUE),
            'is_aktif'         => $this->input->post('is_aktif', TRUE),
        );

        $this->db->insert($this->table, $data);
    }

    //Memperbarui data yang di edit
    function update() {
        $data = array(
            'nama_kurikulum'     => $this->input->post('nama_kurikulum', TRUE),
            'is_aktif'         => $this->input->post('is_aktif', TRUE),
        );

        $id_kurikulum  = $this->input->post('id_kurikulum');
        $this->db->where('id_kurikulum', $id_kurikulum);
        $this->db->update($this->table, $data);
    }

    function addKurikulumDetail(){
        $data = array(
            'id_mapel'  => $this->input->post('id_mapel',TRUE),
            'kelas'       => $this->input->post('kelas',TRUE),
            'id_jurusan'  => $this->input->post('jurusan',TRUE),
            'id_kurikulum'  => $this->input->post('id_kurikulum',TRUE),
        );
        $this->db->insert('tb_kurikulum_detail',$data);
    }
    




}

?>