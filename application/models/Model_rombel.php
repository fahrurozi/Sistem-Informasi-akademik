<?php 

class Model_rombel extends CI_Model {
    
	public $table = 'tb_rombel';
	
	function chekLogin($username,$password){
        $user = $this->db->query(
			"SELECT rom.*, tjr.nama_jurusan 
			FROM tb_rombel as rom, tb_jurusan as tjr
			WHERE rom.id_jurusan=tjr.id_jurusan AND rom.username = '$username' AND rom.password = '".md5($password)."'")->row_array();
        return $user;
    }

    function save() {
        $data = array (
            'id_jurusan' => $this->input->post('id_jurusan', TRUE),
            'kelas' => $this->input->post('kelas', TRUE),
            'nama_rombel' => $this->input->post('nama_rombel', TRUE),
        );
        $this->db->insert($this->table, $data);
    }

    function update() {
        $data = array (
            'id_jurusan'     => $this->input->post('id_jurusan', TRUE),
            'kelas'          => $this->input->post('kelas', TRUE),
            'nama_rombel'    => $this->input->post('nama_rombel', TRUE),
        );
        $id_rombel = $this->input->post('id_rombel');
        $this->db->where('id_rombel',$id_rombel);
        $this->db->update($this->table, $data);
    }

    public function view_rombel(){
		return $this->db->get('tb_rombel')->result(); // Tampilkan semua data yang ada di tabel siswa
	}
	
	// Fungsi untuk melakukan proses upload file
	public function upload_file_rombel($filename){
		$this->load->library('upload'); // Load librari upload
		
		$config['upload_path'] = './assets/upload/import_data_rombel';
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
		$this->db->insert_batch('tb_rombel', $data);
	}
}


?>