<?php

Class Model_tahun_ajaran extends CI_Model {
    
    public $table = 'tb_tahun_ajaran';

    //Menyimpan data yang ditambahkan
    function save() {
        $data = array(
            'tahun_ajaran'     => $this->input->post('tahun', TRUE),
            'is_aktif'         => $this->input->post('is_aktif', TRUE),
            'semester_aktif'   => $this->input->post('semester_aktif', TRUE),
        );

        $this->db->insert($this->table, $data);
    }

    //Memperbarui data yang di edit
    function update() {
        $data = array(
            'tahun_ajaran'    => $this->input->post('tahun', TRUE),
            'is_aktif'        => $this->input->post('is_aktif', TRUE),
            'semester_aktif'  => $this->input->post('semester_aktif', TRUE),
        );

        $id  = $this->input->post('id_tahun_ajaran');
        $this->db->where('id_tahun_ajaran', $id);
		$this->db->update($this->table, $data);

		$this->db->set('is_aktif', 'n');
		$this->db->where('id_tahun_ajaran !=', $id);
		$this->db->update($this->table);
    }


    //import excel
    public function view_tahun_ajaran(){
		return $this->db->get('tb_tahun_ajaran')->result(); // Tampilkan semua data yang ada di tabel siswa
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload_file_tahun_ajaran($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './assets/upload/import_data_tahun_ajaran';
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
		$this->db->insert_batch('tb_tahun_ajaran', $data);
	}


    

}

?>