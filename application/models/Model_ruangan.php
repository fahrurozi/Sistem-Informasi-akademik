<?php

Class Model_ruangan extends CI_Model {
    
    public $table = 'tb_ruangan';

    //Menyimpan data yang ditambahkan
    function save() {
        $data = array(
            'id_ruangan'         => $this->input->post('kode', TRUE),
            'nama_ruangan'       => $this->input->post('ruangan', TRUE),
        );

        $this->db->insert($this->table, $data);
    }

    //Memperbarui data yang di edit
    function update() {
        $data = array(
            'nama_ruangan'       => $this->input->post('ruangan', TRUE),
        );

        $kode    = $this->input->post('id_ruangan');
        $this->db->where('id_ruangan', $kode);
        $this->db->update($this->table, $data);
    }


    public function view_ruangan(){
		return $this->db->get('tb_mapel')->result(); // Tampilkan semua data yang ada di tabel siswa
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload_file_ruangan($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './assets/upload/import_data_ruangan';
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
		$this->db->insert_batch('tb_ruangan', $data);
	}


}

?>