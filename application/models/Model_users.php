<?php

Class Model_users extends CI_Model {
    
    public $table = 'tb_user';

    //Menyimpan data yang ditambahkan
    function save($foto) {
        $data = array(
            'nama_lengkap'      => $this->input->post('nama_lengkap', TRUE),
            'username'          => $this->input->post('username', TRUE),
            'password'          => md5($this->input->post('password', TRUE)),
            'id_level_user'     => '1',
            'foto'              => $foto
        );

        $this->db->insert($this->table, $data);
    }

    //Memperbarui data yang di edit
    function update($foto) {
        
        if(empty($foto)){
            $data = array(
                'nama_lengkap'      => $this->input->post('nama_lengkap', TRUE),
                'username'          => $this->input->post('username', TRUE),
                'id_level_user'     => '1'
            );
        }else{
            $data = array(
                'nama_lengkap'      => $this->input->post('nama_lengkap', TRUE),
                'username'          => $this->input->post('username', TRUE),
                'id_level_user'     => '1',
                'foto'              => $foto
            );
        }
        if($this->input->post('password',TRUE)){
            $data['password'] = md5($this->input->post('password', TRUE));
        }

        $id_user   = $this->input->post('id_user');
        $this->db->where('id_user', $id_user);
        $this->db->update($this->table, $data);
    }




}

?>
