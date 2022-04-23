<?php

Class Model_jurusan extends CI_Model {
    
    public $table = 'tb_jurusan';

    //Menyimpan data yang ditambahkan
    function save() {
        $data = array(
            'id_jurusan'    => $this->input->post('id_jurusan', TRUE),
            'nama_jurusan'    => $this->input->post('nama_jurusan', TRUE),
        );
        $this->db->insert($this->table, $data);
    }

   //Memperbarui data yang di edit
    function update() {
        $data = array(
            'id_jurusan'    => $this->input->post('id_jurusan', TRUE),
            'nama_jurusan'    => $this->input->post('nama_jurusan', TRUE),
        );
        $kode   = $this->input->post('id_jurusan');
        $this->db->where('id_jurusan', $kode);
        $this->db->update($this->table, $data);
    }

    public function view_jurusan(){
		return $this->db->get('tb_jurusan')->result(); // Tampilkan semua data yang ada di tabel siswa
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload_file_jurusan($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './assets/upload/import_data_jurusan';
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
		$this->db->insert_batch('tb_jurusan', $data);
	}
}

?>