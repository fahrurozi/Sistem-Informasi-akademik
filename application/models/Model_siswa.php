<?php

Class Model_siswa extends CI_Model {
    
    public $table = 'tb_siswa';

    //Menyimpan data yang ditambahkan
    function save() {
        $data = array(
            'nis'                => $this->input->post('nis', TRUE),
            'nama'               => $this->input->post('nama', TRUE),
            'gender'             => $this->input->post('gender', TRUE),
            'tanggal_lahir'      => $this->input->post('tanggal_lahir', TRUE),
            'tempat_lahir'       => $this->input->post('tempat_lahir', TRUE),
            'id_agama'           => $this->input->post('agama', TRUE),
            'id_rombel'           => $this->input->post('rombel', TRUE),
        );

        $this->db->insert($this->table, $data);
    }

    //Memperbarui data yang di edit
    function update() {
        $data = array(
            'nama'               => $this->input->post('nama', TRUE),
            'gender'             => $this->input->post('gender', TRUE),
            'tanggal_lahir'      => $this->input->post('tanggal_lahir', TRUE),
            'tempat_lahir'       => $this->input->post('tempat_lahir', TRUE),
            'id_agama'           => $this->input->post('agama', TRUE),
            'id_rombel'           => $this->input->post('rombel', TRUE),
        );

        $nis    = $this->input->post('nis');
        $this->db->where('nis', $nis);
        $this->db->update($this->table, $data);
    }

    public function view_siswa(){
		return $this->db->get('tb_siswa')->result(); // Tampilkan semua data yang ada di tabel siswa
	}

    // Fungsi untuk melakukan proses upload file
    public function upload_file_siswa($filename){
        $this->load->library('upload'); // Load librari upload
        
        $config['upload_path'] = './assets/upload/import_data_siswa';
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
        $this->db->insert_batch('tb_siswa', $data);
    }


}

?>