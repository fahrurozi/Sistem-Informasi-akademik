<?php

Class Guru extends CI_Controller {

    private $filename = "import_data_guru";

	function __construct() {
        parent:: __construct();
        
        $this->load->library('Ssp');
        $this->load->model('Model_guru');
    }

    function data() {
        $table = 'tb_guru';
        $primaryKey = 'id_guru';
        $columns = array(
            array('db' => 'id_guru', 'dt' => 'id_guru'),
            array('db' => 'nip', 'dt' => 'nip'),
            array('db' => 'nama_guru', 'dt' => 'nama_guru'),
            array('db' => 'gender',
                'dt' => 'gender',
                'formatter' => function($d) {
                    return $d=='L'?'Laki-laki':'Perempuan';
            }),
            array(
                'db' => 'id_guru',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('guru/edit/'.$d, '<i class="fa fa-pencil"></i>','class="btn btn-primary" title="Edit"')."&nbsp;&nbsp;&nbsp;"
                          .anchor('guru/delete/'.$d, '<i class="fa fa-trash"></i>','class="btn btn-danger" title="Delete"');
                }
            )
        );
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
 
        echo json_encode(
                SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
        );
    }

    //Menampilkan data
    function index() {
        if($this->session->userdata('id_level_user')!=1){
            $this->template->load('template','guru/list_no_admin');
        }else{
            $this->template->load('template','guru/list');
        }
        
    }

    //Menambahkan data
    function add() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            echo $this->Model_guru->save();
            redirect('guru');
        } else {
            $this->template->load('template','guru/add');
        }
    }

    //Mengedit data
    function edit() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            echo $this->Model_guru->update();
            redirect('guru');
        } else {
            $kode    = $this->uri->segment(3);
            $data['guru'] = $this->db->get_where('tb_guru', array('id_guru'=>$kode))->row_array();
            $this->template->load('template','guru/edit',$data);
        }
    }

    //Menghapus data
    function delete() {
        chekAksesModule();
        $kode    = $this->uri->segment(3);

        if(!empty($kode)) {
            //memproses delete data
            $this->db->where('id_guru', $kode);
            $this->db->delete('tb_guru');
        }

        redirect('guru');
    }

     //import excel
     public function form(){
        chekAksesModule();
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
            // lakukan upload file dengan memanggil function upload yang ada di Model_tahun_ajaran.php
            
            
			$upload = $this->Model_guru->upload_file_guru($this->filename);
            
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/upload/import_data_guru/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->template->load('template','guru/form',$data);
	}
	
	public function import(){
		// Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';
        
	
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('assets/upload/import_data_guru/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
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
					'nip'=>$row['A'], // Insert data nis dari kolom A di excel
                    'nama_guru'=>$row['B'], // Insert data nama dari kolom B di excel
                    'gender'=>$row['C'],
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->Model_guru->insert_multiple($data);
		
		redirect("guru"); // Redirect ke halaman awal (ke controller siswa fungsi index)
    }
    
}

?>
