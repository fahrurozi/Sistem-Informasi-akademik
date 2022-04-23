<?php

Class Model_guru extends CI_Model {
    
    public $table = 'tb_guru';

    //Menyimpan data yang ditambahkan
    function save() {
        $data = array(
            'nip'      => $this->input->post('nip', TRUE),
            'nama_guru'    => $this->input->post('nama_guru', TRUE),
            'gender'    => $this->input->post('gender', TRUE),
            'username'    => $this->input->post('username', TRUE),
            'password'    => md5($this->input->post('password', TRUE)),
        );

        $this->db->insert($this->table, $data);
    }

    //Memperbarui data yang di edit
    function update() {
        $data = array(
            'nip'      => $this->input->post('nip', TRUE),
            'nama_guru'    => $this->input->post('nama_guru', TRUE),
            'gender'    => $this->input->post('gender', TRUE),
        );

        $kode   = $this->input->post('id_guru');
        $this->db->where('id_guru', $kode);
        $this->db->update($this->table, $data);
    }

    function chekLogin($username,$password){
        //$user = $this->db->query("SELECT g.*, wk.id_rombel FROM tb_guru g LEFT JOIN tb_walikelas wk ON wk.id_guru = g.id_guru WHERE username = '$username' AND password = '".md5($password)."'")->row_array();
        $user = $this->db->query(
            "SELECT g.*, wk.id_rombel, tr.id_jurusan 
            FROM tb_guru g LEFT JOIN tb_walikelas wk ON wk.id_guru = g.id_guru LEFT JOIN tb_rombel tr ON tr.id_rombel=wk.id_rombel 
            WHERE g.username = '$username' AND g.password = '".md5($password)."'")->row_array();
        return $user;
    }

    // Fungsi untuk melakukan proses upload file
    public function upload_file_guru($filename){
        $this->load->library('upload'); // Load librari upload
        
        $config['upload_path'] = './assets/upload/import_data_guru';
        $config['allowed_types'] = 'xlsx';
        $config['max_size']	= '2048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;

        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        }else{
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
    public function insert_multiple($data){
        $this->db->insert_batch('tb_guru', $data);
    }


}

?>