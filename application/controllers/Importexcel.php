<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Importexcel extends CI_Controller {
	private $filename = "import_data"; // Kita tentukan nama filenya
	
	public function __construct(){
		parent::__construct();
		$this->load->library('ssp');
		$this->load->model('Model_importexcel');
	}
	
	public function index(){
		$data['jurusan'] = $this->Model_importexcel->view();
        $this->template->load('template','jurusan/list',$data);
	}
	
	public function form(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di Model_importexcel.php
			$upload = $this->Model_importexcel->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/upload/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->template->load('template','importexcel/form',$data);
	}
	
	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('assets/upload/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					'id_jurusan'=>$row['A'], // Insert data nis dari kolom A di excel
					'nama_jurusan'=>$row['B'], // Insert data nama dari kolom B di excel
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->Model_importexcel->insert_multiple($data);
		
		redirect("Jurusan"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
}
