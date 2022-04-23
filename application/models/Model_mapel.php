<?php

Class Model_mapel extends CI_Model {
    
    public $table = 'tb_mapel';

    //Menyimpan data yang ditambahkan
    function save() {
        $data = array(
            'id_mapel'      => $this->input->post('kd', TRUE),
            'nama_mapel'    => $this->input->post('mapel', TRUE)
        );

        $this->db->insert($this->table, $data);
    }

    //Memperbarui data yang di edit
    function update() {
        $data = array(
            'nama_mapel'    => $this->input->post('mapel', TRUE)
        );

        $kode   = $this->input->post('id_mapel');
        $this->db->where('id_mapel', $kode);
        $this->db->update($this->table, $data);
    }


    public function view_mapel(){
		return $this->db->get('tb_mapel')->result(); // Tampilkan semua data yang ada di tabel siswa
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload_file_mapel($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './assets/upload/import_data_mapel';
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
		$this->db->insert_batch('tb_mapel', $data);
	}




}

?>