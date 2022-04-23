<?php

Class Tahun_ajaran extends CI_Controller {

    private $filename = "import_data_tahun_ajaran"; // Kita tentukan nama filenya

	function __construct() {
        parent:: __construct();
        $this->load->library('ssp');
        $this->load->model('Model_tahun_ajaran');
    }

    function data() {
        $table = 'tb_tahun_ajaran';
        $primaryKey = 'id_tahun_ajaran';
        $columns = array(
            array('db' => 'id_tahun_ajaran', 'dt' => 'id_tahun_ajaran'),
            array('db' => 'tahun_ajaran', 'dt' => 'tahun_ajaran'),
            array('db' => 'is_aktif', 
                  'dt' => 'is_aktif',
                  'formatter' => function($d) {
                      return $d=='y'?'AKTIF':'TIDAK';
                  }
            ),
            array('db' => 'semester_aktif', 
                  'dt' => 'semester_aktif',
                  'formatter' => function($d) {
                    return $d=='1'?'GANJIL':'GENAP';
                  }    
            ),
            array(
                'db' => 'id_tahun_ajaran',
                'dt' => 'aksi',
                'formatter' => function($d) {
                    return anchor('tahun_ajaran/edit/'.$d, '<i class="fa fa-pencil"></i>','class="btn btn-primary" title="Edit"')."&nbsp;&nbsp;&nbsp;"
                          .anchor('tahun_ajaran/delete/'.$d, '<i class="fa fa-trash"></i>','class="btn btn-danger" title="Delete"');
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
        $data['tahun_ajaran'] = $this->Model_tahun_ajaran->view_tahun_ajaran();
        if($this->session->userdata('id_level_user')!=1){
            $this->template->load('template','tahun_ajaran/list_no_admin');
        }else{
            $this->template->load('template','tahun_ajaran/list');
        }
        
    }

    //Menambahkan data
    function add() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            echo $this->Model_tahun_ajaran->save();
            $idTahunAjaran = $this->db->insert_id();
            //setup data dumy walikelas
            $this->load->model('Model_walikelas');
            $this->Model_walikelas->setup_walikelas($idTahunAjaran);
            //echo $this->Model_tahun_ajaran->save();
            redirect('tahun_ajaran');
        } else {
            $this->template->load('template','tahun_ajaran/add');
        }
    }

    //Mengedit data
    function edit() {
        chekAksesModule();
        if(isset($_POST['submit'])) {
            echo $this->Model_tahun_ajaran->update();
            redirect('tahun_ajaran');
        } else {
            $id    = $this->uri->segment(3);
            $data['tahun_ajaran'] = $this->db->get_where('tb_tahun_ajaran', array('id_tahun_ajaran'=>$id))->row_array();
            $this->template->load('template','tahun_ajaran/edit',$data);
        }
    }

    //Menghapus data
    function delete() {
        chekAksesModule();
        $id    = $this->uri->segment(3);

        if(!empty($id)) {
            //memproses delete data
            $this->db->where('id_tahun_ajaran', $id);
            $this->db->delete('tb_tahun_ajaran');
        }

        redirect('tahun_ajaran');
    }


    //import excel
    public function form(){
        chekAksesModule();
        
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di Model_tahun_ajaran.php
			$upload = $this->Model_tahun_ajaran->upload_file_tahun_ajaran($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('assets/upload/import_data_tahun_ajaran/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
			}
		}
		
		$this->template->load('template','tahun_ajaran/form',$data);
	}
	
	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('assets/upload/import_data_tahun_ajaran/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
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
					'tahun_ajaran'=>$row['A'], // Insert data nis dari kolom A di excel
                    'is_aktif'=>$row['B'], // Insert data nama dari kolom B di excel
                    'semester_aktif'=>$row['C'], // Insert data nama dari kolom B di excel
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->Model_tahun_ajaran->insert_multiple($data);
		
		redirect("tahun_ajaran"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
}

?>
